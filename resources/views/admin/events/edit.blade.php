<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editare Eveniment: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    {{-- Formularul de editare eveniment --}}
                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Câmpuri pentru editarea evenimentului --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Titlu --}}
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Titlu Eveniment</label>
                                <input type="text" name="title" id="title" value="{{ $event->title }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>

                            {{-- Descriere --}}
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Descriere</label>
                                <textarea name="description" id="description" rows="4"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $event->description }}</textarea>
                            </div>

                            {{-- Locație --}}
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Locație</label>
                                <input type="text" name="location" id="location" value="{{ $event->location }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>

                            {{-- Preț Bilet --}}
                            <div>
                                <label for="ticket_price" class="block text-sm font-medium text-gray-700">Preț Bilet</label>
                                <input type="number" name="ticket_price" id="ticket_price" value="{{ $event->ticket_price }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>

                            {{-- Data și Ora --}}
                            <div>
                                <label for="date_time" class="block text-sm font-medium text-gray-700">Data și Ora</label>
                                <input type="datetime-local" name="date_time" id="date_time" value="{{ $event->date_time }}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                        </div>

                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                            Actualizează Eveniment
                        </button>
                    </form>

                    {{-- Managementul sponsorilor, speakerilor și partenerilor --}}
                    <div class="mt-8 space-y-4">
                        <div class="mt-4 flex justify-start space-x-2">
                            <form action="{{ route('events.addSponsors', $event) }}" method="POST">
                                @csrf
                                <select name="sponsor_id" style="width:150px"
                                        class="border border-gray-300 rounded-md shadow-sm p-2">
                                    @foreach ($sponsors as $sponsor)
                                        <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Adaugă Sponsor
                                </button>
                            </form>
                            @if(!$event->sponsors->isEmpty())
                                <form action="{{ route('events.removeSponsor', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <select name="sponsor_id" style="width:150px"
                                            class="border border-gray-300 rounded-md shadow-sm p-2">
                                        @foreach ($event->sponsors as $sponsor)
                                            <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" style="width: 150px"
                                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                        Șterge Sponsor
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="mt-4 flex justify-start space-x-2">
                            <form action="{{ route('admin.events.addSpeakerForm', $event) }}" method="POST">
                                @csrf
                                <select name="speaker_id" style="width:150px"
                                        class="border border-gray-300 rounded-md shadow-sm p-2">
                                    @foreach ($speakers as $speaker)
                                        <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Adaugă Speaker
                                </button>
                            </form>
                            @if($event->speakers && !$event->speakers->isEmpty())
                                <form action="{{ route('events.removeSpeaker', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <select name="speaker_id" style="width:150px"
                                            class="border border-gray-300 rounded-md shadow-sm p-2">
                                        @foreach ($event->speakers as $speaker)
                                            <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" style="width: 150px"
                                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                        Șterge Speaker
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="mt-4 flex justify-start space-x-2">
                            <form action="{{ route('admin.events.addPartnerForm', $event) }}" method="POST">
                                @csrf
                                <select name="partner_id" style="width:150px"
                                        class="border border-gray-300 rounded-md shadow-sm p-2">
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Adaugă Partener
                                </button>
                            </form>
                            @if($event->partners && !$event->partners->isEmpty())
                                <form action="{{ route('events.removePartner', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <select name="partner_id" style="width:150px"
                                            class="border border-gray-300 rounded-md shadow-sm p-2">
                                        @foreach ($event->partners as $partner)
                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" style="width: 150px"
                                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                        Șterge Partener
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
