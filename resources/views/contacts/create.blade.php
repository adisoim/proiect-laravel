<x-layouts.partner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Completează Datele de Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('contacts.store') }}" method="POST" class="p-6">
                    @csrf
                    <!-- Nume Complet -->
                    <div class="mb-4">
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Nume Complet</label>
                        <input type="text" id="full_name" name="full_name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               required>
                    </div>

                    <!-- Adresă de Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresă de Email</label>
                        <input type="email" id="email" name="email"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               required>
                    </div>

                    <!-- Număr de Telefon -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Număr de
                            Telefon</label>
                        <input type="tel" id="phone" name="phone" maxlength="10"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               required>
                    </div>

                    <!-- Mesaj -->
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Mesaj</label>
                        <textarea id="message" name="message" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                  required></textarea>
                    </div>

                    <!-- Buton de Trimitere -->
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Trimite Datele
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.partner-layout>
