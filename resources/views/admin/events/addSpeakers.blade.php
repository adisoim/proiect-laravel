<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adaugă Speaker pentru Eveniment: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form action="{{ route('admin.events.addSpeakers', $event) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="speaker_id" class="block text-gray-700 text-sm font-bold mb-2">Selectează Speaker:</label>
                        <select name="speaker_id" id="speaker_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($speakers as $speaker)
                                <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                            @endforeach
                        </select>
                        @error('speaker_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Adaugă Speaker
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
