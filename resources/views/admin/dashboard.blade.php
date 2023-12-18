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

                    {{-- Evenimente Recente --}}
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Evenimente Recente</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        @forelse ($events as $event)
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <h4 class="font-bold text-lg mb-2">{{ $event->title }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $event->description }}</p>
                                <p class="text-sm text-gray-600 mb-2">Preț Bilet: {{ $event->ticket_price }}</p>
                                <p class="text-sm text-gray-600 mb-4">Data și Ora: {{ $event->date_time }}</p>
                                <div class="flex justify-between">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="text-white bg-blue-600 hover:bg-blue-700 rounded py-2 px-4">Editează</a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 rounded py-2 px-4">Șterge</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p>Nu există evenimente de afișat.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('admin.events.create') }}"
                           class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                            Creează Eveniment
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="mt-4 text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Management Sponsori</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Iterează prin sponsori --}}
                        @forelse ($sponsors as $sponsor)
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <h4 class="text-lg font-medium">{{ $sponsor->name }}</h4>
                                <form method="GET" action="{{ route('sponsors.edit', $sponsor->id) }}">
                                    <button type="submit" class="text-white bg-blue-600 px-3 py-1 rounded hover:bg-blue-700 transition duration-300">
                                        Editează
                                    </button>
                                </form>
                                <div class="mt-2">
                                    <form method="POST" action="{{ route('sponsors.destroy', $sponsor->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition duration-300">
                                            Șterge
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-gray-500 dark:text-gray-400">Nu există sponsori de afișat.</div>
                        @endforelse

                        <div class="flex justify-between items-center">
                            <a href="{{ route('sponsors.create') }}" class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                                Creează Sponsor
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="mt-4 text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Management Speakeri</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Iterează prin sponsori --}}
                        @forelse ($speakers as $speaker)
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <h4 class="text-lg font-medium">{{ $speaker->name }}</h4>
                                <form method="GET" action="{{ route('speakers.edit', $speaker->id) }}">
                                    <button type="submit" class="text-white bg-blue-600 px-3 py-1 rounded hover:bg-blue-700 transition duration-300">
                                        Editează
                                    </button>
                                </form>
                                <div class="mt-2">
                                    <form method="POST" action="{{ route('speakers.destroy', $speaker->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition duration-300">
                                            Șterge
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-gray-500 dark:text-gray-400">Nu există speakeri de afișat.</div>
                        @endforelse

                        <div class="flex justify-between items-center">
                            <a href="{{ route('speakers.create') }}" class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                                Creează Speaker
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="mt-4 text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Management Parteneri</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($partners as $partner)
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <h4 class="text-lg font-medium">{{ $partner->name }}</h4>
                                <form method="GET" action="{{ route('partners.edit', $partner->id) }}">
                                    <button type="submit" class="text-white bg-blue-600 px-3 py-1 rounded hover:bg-blue-700 transition duration-300">
                                        Editează
                                    </button>
                                </form>
                                <div class="mt-2">
                                    <form method="POST" action="{{ route('partners.destroy', $partner->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition duration-300">
                                            Șterge
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-gray-500 dark:text-gray-400">Nu există parteneri de afișat.</div>
                        @endforelse

                        <div class="flex justify-between items-center">
                            <a href="{{ route('partners.create') }}" class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                                Creează Partener
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="mt-4 text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Management Contact</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Iterează prin contacte --}}
                        @forelse ($contacts as $contact)
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <h4 class="text-lg font-medium">{{ $contact->full_name }}</h4>
                                {{-- Afișează alte detalii ale contactului --}}
                                <p>{{ $contact->email }}</p>
                                <p>{{ $contact->phone }}</p>
                                <p>{{ $contact->message }}</p>
                                <div class="mt-2">
                                    <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition duration-300">
                                            Șterge
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-gray-500 dark:text-gray-400">Nu există contacte de afișat.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script>
        function openTab(tabName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("tab-content");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-button");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</x-app-layout>
