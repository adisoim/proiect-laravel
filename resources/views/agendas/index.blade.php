<x-layouts.agenda-layout>
    <div class="container mx-auto p-4">
        @foreach ($agendas as $agenda)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $agenda->title }}</h2>
                    <p class="text-gray-600">{{ $agenda->description }}</p>
                    <div class="mt-2">
                        <span class="text-gray-800 font-semibold">Locație:</span> {{ $agenda->location }}
                    </div>
                    <a href="{{ route('agendas.index', $agenda->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-300 py-2 px-4 ">Detalii agenda</a>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.agenda-layout>
