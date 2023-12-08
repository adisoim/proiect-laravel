<x-event-layout>
    <div class="container mx-auto p-4">
        @foreach ($events as $event)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                    <p class="text-gray-600">{{ $event->description }}</p>
                    <div class="mt-2">
                        <span class="text-gray-800 font-semibold">Locație:</span> {{ $event->location }}
                    </div>
                    <div class="mt-2">
                        <span class="text-gray-800 font-semibold">Preț Bilet:</span> {{ $event->ticket_price }}
                    </div>
                    <!-- Butonul Buy - Acesta poate deschide un modal sau o altă pagină pentru achiziție -->
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Cumpără Bilet
                    </button>
                    <a href="{{ url('/events/' . $event->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-300 py-2 px-4 ">Detalii eveniment</a>
                </div>
            </div>
        @endforeach
    </div>
</x-event-layout>
