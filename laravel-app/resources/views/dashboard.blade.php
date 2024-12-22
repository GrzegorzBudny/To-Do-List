<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(request()->input('view') === 'tasks')
                        <h1 class="text-2xl font-bold mb-4">{{ __('Your Tasks') }}</h1>
                        <a href="{{ route('tasks.create') }}" class="text-blue-500 underline">Create New Task</a>
                        <table class="table-auto w-full mt-4 border-collapse border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">Name</th>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif(request()->input('view') === 'history')
                        <h1 class="text-lg font-bold mb-4">{{ __('Task History') }}</h1>
                        @if ($history->isEmpty())
                            <p class="text-gray-600">{{ __('No history records found for this task.') }}</p>
                        @else
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Field Changed') }}</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Previous Value') }}</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('New Value') }}</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Changed At') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history as $record)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2">{{ $record->field_changed }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $record->previous_value }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $record->new_value }}</td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $record->changed_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @elseif(request()->input('view') === 'shared')
                        <h1 class="text-lg font-bold mb-4">{{ __('Shared Task') }}</h1>
                        <p class="mb-2"><strong class="font-semibold">{{ __('Description:') }}</strong> {{ $task->description }}</p>
                        <p class="mb-2"><strong class="font-semibold">{{ __('Priority:') }}</strong> 
                            <span class="@if($task->priority === 'high') text-red-500 
                                          @elseif($task->priority === 'medium') text-yellow-500 
                                          @else text-green-500 @endif">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </p>
                        <p class="mb-2"><strong class="font-semibold">{{ __('Status:') }}</strong> 
                            <span class="@if($task->status === 'done') text-green-600 
                                          @elseif($task->status === 'in-progress') text-blue-500 
                                          @else text-gray-500 @endif">
                                {{ ucfirst($task->status) }}
                            </span>
                        </p>
                        <p class="mb-2"><strong class="font-semibold">{{ __('Due Date:') }}</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</p>
                    @else
                        <p>{{ __("You're logged in!") }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
