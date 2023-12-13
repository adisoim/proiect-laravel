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
                    <div class="mt-2">
                        <h3 class="text-gray-800 font-semibold">Sponsori:</h3>
                        @forelse ($event->sponsors as $sponsor)
                            <p>{{ $sponsor->name }}</p> <!-- Presupunând că sponsorii au un atribut 'name' -->
                        @empty
                            <p>Nu există sponsori pentru acest eveniment.</p>
                        @endforelse
                    </div>
                    <a href="{{ url('/events/' . $event->id) }}"  class=" text-indigo-600 hover:text-indigo-900 transition duration-300 ">Detalii eveniment</a>

                    @if($event->ticket)
                    <form action="{{ route('cart.add', ['ticketId' => $event->ticket->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="ticketId" value="{{ $event->ticket->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                                Cumpără Bilet
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        @endforeach
    </div>
</x-event-layout>
