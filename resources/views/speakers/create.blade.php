<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creează Speaker Nou') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('speakers.store') }}" method="POST" class="p-6">
                    @csrf
                    <!-- Nume Speaker -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nume Speaker</label>
                        <input type="text" id="name" name="name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               required>
                    </div>

                    <!-- Descriere Speaker -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descriere</label>
                        <textarea id="description" name="description" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>

                    <!-- Buton de Creare -->
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Creează Speaker
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
