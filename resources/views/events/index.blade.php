<x-event-layout>
    <div class="container mx-auto p-4">
        @foreach ($events as $event)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="md:flex">
                    <!-- Imagine Eveniment -->
                    <img class="h-48 w-full md:w-1/3 object-cover" src="{{ Storage::url($event->image) }}" alt="Imagine Eveniment">

                    <div class="p-4 md:w-2/3">
                        <h2 class="text-2xl font-bold mb-2">{{ $event->title }}</h2>
                        <p class="text-gray-700 mb-4">{{ $event->description }}</p>

                        <div class="flex flex-wrap text-sm mb-4">
                            <div class="w-full md:w-1/2 mb-2 md:mb-0">
                                <span class="text-gray-800 font-semibold">Locație:</span> {{ $event->location }}
                            </div>
                            <div class="w-full md:w-1/2">
                                <span class="text-gray-800 font-semibold">Preț Bilet:</span> {{ $event->ticket_price }} RON
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-gray-800 font-semibold">Sponsori:</h3>
                            <div class="flex flex-wrap">
                                @forelse ($event->sponsors as $sponsor)
                                    <div class="mr-4 mb-2">{{ $sponsor->name }}</div>
                                @empty
                                    <p>Nu există sponsori pentru acest eveniment.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ url('/events/' . $event->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-300">Detalii eveniment</a>
                            @if($event->ticket)
                                <form action="{{ route('cart.add', ['ticketId' => $event->ticket->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Cumpără Bilet
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-event-layout>
