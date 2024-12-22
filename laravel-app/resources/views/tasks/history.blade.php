<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task History: ') }} {{ $task->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('tasks.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">
                        {{ __('← Back to Tasks') }}
                    </a>

                    <h1 class="text-lg font-bold mb-4">{{ __('History for Task: ') }} {{ $task->name }}</h1>

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
                                        <td class="border border-gray-300 px-4 py-2">{{ $record->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
