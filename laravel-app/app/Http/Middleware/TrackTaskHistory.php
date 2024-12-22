<?php

namespace App\Http\Middleware;

use App\Models\TaskHistory;
use Closure;
use Illuminate\Http\Request;

class TrackTaskHistory
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->route('task') && $request->isMethod('PUT')) {
            $task = $request->route('task');
            $changes = $task->getDirty();

            foreach ($changes as $field => $newValue) {
                TaskHistory::create([
                    'task_id' => $task->id,
                    'field_changed' => $field,
                    'previous_value' => $task->getOriginal($field),
                    'new_value' => $newValue,
                ]);
            }
        }

        return $response;
    }
}

