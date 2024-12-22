<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shared Task: ') }} {{ $task->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-lg font-bold mb-4">{{ __('Task Details') }}</h1>

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

                    <!-- Link back to Tasks -->
                    <a href="{{ route('dashboard') }}?view=tasks" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        {{ __('Back to Task List') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
