<x-event-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $event->title }}</h1>

            <div class="container mx-auto p-4">
                <p>{{ $event->description }}</p>
                <p>Locație: {{ $event->location }}</p>
                <p>Preț Bilet: {{ $event->ticket_price }}</p>
                <p>Data și Ora: {{ $event->date_time }}</p>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Cumpără Bilet
                </button>
            </div>

</div>
</x-event-layout>
