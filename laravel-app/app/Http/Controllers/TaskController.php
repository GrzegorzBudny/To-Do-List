<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\TaskHistory;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->when($request->priority, fn($query) => $query->where('priority', $request->priority))
            ->when($request->status, fn($query) => $query->where('status', $request->status))
            ->when($request->due_date, fn($query) => $query->where('due_date', $request->due_date))
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in-progress,done',
            'due_date' => 'required|date',
        ]);

        $task = Auth::user()->tasks()->create($request->all());

        TaskHistory::create([
            'task_id' => $task->id,
            'field_changed' => 'Created',
            'previous_value' => null,
            'new_value' => 'Task Created',
            'changed_at' => now(),
        ]);

        $view = $request->input('view', 'tasks');
        return redirect()->route('dashboard', ['view' => $view])->with('success', 'Task created successfully!');;
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in-progress,done',
            'due_date' => 'required|date',
        ]);
    
        $original = $task->getOriginal();
        
        $trackableFields = ['name', 'description', 'priority', 'status', 'due_date'];
        $changes = [];
    
        foreach ($trackableFields as $field) {
            if ($original[$field] !== $validated[$field]) {
                $changes[$field] = [
                    'previous_value' => $original[$field],
                    'new_value' => $validated[$field],
                ];
            }
        }
    
        foreach ($changes as $field => $change) {
            TaskHistory::create([
                'task_id' => $task->id,
                'field_changed' => $field,
                'previous_value' => $change['previous_value'],
                'new_value' => $change['new_value'],
                'changed_at' => now(),
            ]);
        }
    
        $task->update($validated);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }
    

    public function history(Task $task)
    {
        $this->authorize('view', $task);

        $history = $task->histories()->latest()->get();

        return view('tasks.history', compact('task', 'history'));
    }

    public function share(Task $task)
    {
        $this->authorize('view', $task);
    
        $task->update([
            'token' => bin2hex(random_bytes(16)),
            'token_expires_at' => now()->addHours(24),
        ]);
    
        return back()->with('link', route('tasks.shared', $task->token));
    }

    public function showShared($token)
    {
        $task = Task::where('token', $token)
            ->where('token_expires_at', '>', now())
            ->firstOrFail();
    
        return view('tasks.shared', compact('task'));
    }
    public function dashboard(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        $task = Task::latest()->first();
        $history = $task ? $task->histories()->get() : collect();

        $view = $request->input('view', 'tasks');
    
        return view('tasks.index', compact( 'tasks', 'task', 'history', 'view'));
    }        

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        TaskHistory::create([
            'task_id' => $task->id,
            'field_changed' => 'Deleted',
            'previous_value' => null,
            'new_value' => 'Task Deleted',
            'changed_at' => now(),
        ]);
        
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');;
    }
}
