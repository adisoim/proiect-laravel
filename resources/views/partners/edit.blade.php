<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editare Partener: {{ $partner->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('partners.update', $partner  ->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nume Partener</label>
                            <input type="text" name="name" id="name" value="{{ $partner->name }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descriere</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $partner->description }}</textarea>
                        </div>

                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                            Actualizează Partener
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>