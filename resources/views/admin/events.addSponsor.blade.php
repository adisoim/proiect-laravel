<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adaugă Sponsor pentru Eveniment: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form action="{{ route('admin.events.addSponsor', $event) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="sponsor_id" class="block text-gray-700 text-sm font-bold mb-2">Selectează Sponsor:</label>
                        <select name="sponsor_id" id="sponsor_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($sponsors as $sponsor)
                                <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                            @endforeach
                        </select>
                        @error('sponsor_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Adaugă Sponsor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
