<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panoul de Control al Administratorului') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Evenimente Recente</h3>
                    <div class="mt-6">
                        <!-- Lista evenimentelor -->
            @forelse ($events as $event)
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $event->title }}</div>
                        <div class="ml-2 flex-shrink-0 flex">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $event->location }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {{ $event->description }}
                    </div>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Preț Bilet: {{ $event->ticket_price }}
                    </div>
                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Data și Ora: {{ $event->date_time }}
                        </div>
                    <div class="mt-4 flex justify-start space-x-2">
                        <form action="{{ route('events.addSponsors', $event) }}" method="POST">
                            @csrf
                            <select name="sponsor_id" style="width:150px" class="border border-gray-300 rounded-md shadow-sm p-2">
                                @foreach ($sponsors as $sponsor)
                                    <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Adaugă Sponsor</button>
                        </form>
                        @if(!$event->sponsors->isEmpty())
                        <form action="{{ route('events.removeSponsor', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <select name="sponsor_id" style="width:150px" class="border border-gray-300 rounded-md shadow-sm p-2">
                                @foreach ($event->sponsors as $sponsor)
                                    <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" style="width: 150px" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">Șterge Sponsor</button>
                        </form>
                    @endif
                    </div>

                </div>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">Șterge</button>
                    </form>
                @empty
                    <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        Nu există evenimente de afișat.
                    </div>
                @endforelse
                    </div>

                    <button style="width: 300px" class="mt-4 px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                        <a href="{{ route('sponsors.create') }}"  class="btn btn-link">Creeaza Sponsori</a>
                    </button>

                    <div class="mt-4">
                        @if($sponsors->count())
                            @foreach ($sponsors as $sponsor)
                                <form method="POST" action="{{ route('sponsors.destroy', ['sponsor' => $sponsor->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">Șterge Sponsor {{ $sponsor->name }}</button>
                                </form>
                            @endforeach
                        @else
                            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                Nu există sponsori de afișat.
                            </div>
                        @endif
                    </div>

                    <!-- Partea de formular pentru crearea unui nou eveniment -->

                    <div class="mt-8">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Creează un Eveniment Nou</h3>
                        <form action="{{ route('admin.events.store') }}" method="POST" class="mt-6">
                            @csrf <!-- Token CSRF pentru securitate -->
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Titlu Eveniment</label>
                                    <input type="text" name="title" id="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Descriere</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Locație</label>
                                    <input type="text" name="location" id="location" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label for="ticket_price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Preț Bilet</label>
                                    <input type="number" name="ticket_price" id="ticket_price" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label for="date_time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Data și Ora</label>
                                    <input type="datetime-local" name="date_time" id="date_time" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Crează Eveniment</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
