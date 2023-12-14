<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Creează un Eveniment Nou</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Completează detaliile evenimentului.</p>

                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Titlu Eveniment</label>
                            <input type="text" name="title" id="title" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                <div>
                    <label for="description"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-200">Descriere</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                </div>
{{--                        IMAGINE                          --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagine Eveniment</label>
                            <input type="file" name="image" id="image"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                   required>
                        </div>
                <div>

                    <label for="location"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-200">Locație</label>
                    <input type="text" name="location" id="location" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label for="ticket_price"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-200">Preț
                        Bilet</label>
                    <input type="number" name="ticket_price" id="ticket_price" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label for="date_time"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-200">Data și
                        Ora</label>
                    <input type="datetime-local" name="date_time" id="date_time" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                        <div>
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Creează Eveniment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
