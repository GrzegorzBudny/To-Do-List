<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Your Tasks</h1>
                    <a href="{{ route('tasks.create') }}" class="text-blue-500 underline">Create New Task</a>
                    <form action="{{ route('tasks.index') }}" method="GET" class="mt-4">
                        <div class="flex space-x-4">
                            <select name="priority" class="border p-2 rounded">
                                <option value="">Select Priority</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>

                            <select name="status" class="border p-2 rounded">
                                <option value="">Select Status</option>
                                <option value="to-do" {{ request('status') == 'to-do' ? 'selected' : '' }}>To Do</option>
                                <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                            </select>

                            <input type="date" name="due_date" class="border p-2 rounded" value="{{ request('due_date') }}">
                            
                            <x-primary-button class="ms-3">
                                {{ __('Apply Filters') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <table class="table-auto w-full mt-4 border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                                <th class="border border-gray-300 px-4 py-2">Description</th>
                                <th class="border border-gray-300 px-4 py-2">Priority</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Due Date</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $task->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $task->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $task->priority }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $task->status }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $task->due_date }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 underline">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 underline">Delete</button>
                                    </form>
                                    <form action="{{ route('tasks.share', $task) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-purple-500 underline">Generate Shareable Link</button>
                                    </form>
                                    <a href="{{ route('tasks.history', $task) }}" class="text-green-500 underline">Task History</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @if (session('link'))
                        <p class="mt-4 text-green-500">Shareable Link: <a href="{{ session('link') }}" class="text-blue-500 underline">{{ session('link') }}</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
