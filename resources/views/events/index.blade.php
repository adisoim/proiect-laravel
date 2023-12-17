<x-event-layout>
    <div class="container mx-auto p-4">
        @foreach ($events as $event)
            <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <!-- Imaginea evenimentului în stânga -->
                <div class="md:w-1/4">
                    <img class="object-cover object-center w-96 h-full" src="{{ Storage::url($event->image) }}" alt="Imagine Eveniment">
                </div>

                <!-- Conținutul evenimentului în dreapta -->
                <div class="p-4 md:w-3/4">
                    <h2 class="text-2xl font-bold mb-2">{{ $event->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $event->description }}</p>

                    <div class="text-sm text-gray-600 mb-2">
                        Locație: <strong>{{ $event->location }}</strong>
                    </div>

                    <div class="text-sm text-gray-600 mb-2">
                        Data și Ora: <strong>{{ \Carbon\Carbon::parse($event->date_time)->format('d M Y, H:i') }}</strong>
                    </div>

                    <div class="text-lg font-semibold text-green-500 mb-4">
                        Preț Bilet: <strong>{{ $event->ticket_price }} RON</strong>
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

                            <div class="mb-4">
                                <h3 class="text-gray-800 font-semibold">Speakeri:</h3>
                                <div class="flex flex-wrap">
                                    @forelse ($event->speakers as $speaker)
                                        <div class="mr-4 mb-2">{{ $speaker->name }}</div>
                                    @empty
                                        <p>Nu există speakeri pentru acest eveniment.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-gray-800 font-semibold">Parteneri:</h3>
                                <div class="flex flex-wrap">
                                    @forelse ($event->partners as $partner)
                                        <div class="mr-4 mb-2">{{ $partner->name }}</div>
                                    @empty
                                        <p>Nu există parteneri pentru acest eveniment.</p>
                                    @endforelse
                                </div>
                            </div>

                    <div class="mt-4">
                        <a href="{{ url('/events/' . $event->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-300">Detalii eveniment</a>
                        @if($event->ticket)
                            <form action="{{ route('cart.add', ['ticketId' => $event->ticket->id]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Cumpără Bilet
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-event-layout>
