<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Task Name*') }}</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Task Description') }}</label>
                            <textarea id="description" name="description" class="mt-1 block w-full"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700">{{ __('Priority') }}</label>
                            <select id="priority" name="priority" class="mt-1 block w-full">
                                <option value="low">{{ __('Low') }}</option>
                                <option value="medium">{{ __('Medium') }}</option>
                                <option value="high">{{ __('High') }}</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                            <select id="status" name="status" class="mt-1 block w-full">
                                <option value="to-do">{{ __('To-Do') }}</option>
                                <option value="in-progress">{{ __('In Progress') }}</option>
                                <option value="done">{{ __('Done') }}</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">{{ __('Due Date') }}</label>
                            <input type="date" id="due_date" name="due_date" class="mt-1 block w-full" required>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('dashboard') }}?view=tasks" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Back to Task List') }}
                            </a>

                            <x-primary-button class="ms-3">
                                {{ __('Create Task') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
