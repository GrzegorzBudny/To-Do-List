<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Edit Task: {{ $task->name }}</h1>

                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Task Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $task->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Task Description') }}</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="4"
                            >{{ old('description', $task->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700">{{ __('Priority') }}</label>
                            <select id="priority" name="priority" class="mt-1 block w-full" required>
                                <option value="low" @selected(old('priority', $task->priority) == 'low')>{{ __('Low') }}</option>
                                <option value="medium" @selected(old('priority', $task->priority) == 'medium')>{{ __('Medium') }}</option>
                                <option value="high" @selected(old('priority', $task->priority) == 'high')>{{ __('High') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                            <select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="to-do" @selected(old('status', $task->status) == 'to-do')>{{ __('To-Do') }}</option>
                                <option value="in-progress" @selected(old('status', $task->status) == 'in-progress')>{{ __('In Progress') }}</option>
                                <option value="done" @selected(old('status', $task->status) == 'done')>{{ __('Done') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="due_date" :value="__('Due Date')" />
                            <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date', $task->due_date)" required />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Back to Task List') }}
                            </a>

                            <x-primary-button class="ms-3">
                                {{ __('Update Task') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
