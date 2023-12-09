<x-event-layout>
    <div class="container mx-auto p-4">
        @foreach ($speakers as $speaker)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $speaker->name }}</h2>
                    <p class="text-gray-600">{{ $speaker->description }}</p>
                    <a href="{{ route('speakers.index', $speaker->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-300 py-2 px-4 ">Detalii speaker</a>
                </div>
            </div>
        @endforeach
    </div>
</x-event-layout>
