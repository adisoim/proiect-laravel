{{-- layout pentru speakeri --}}
<x-layouts.speaker-layout>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($speakers as $speaker)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $speaker->name }}</h2>
                        <p>{{ $speaker->description }}</p>
                        {{-- Dacă ai alte câmpuri cum ar fi imaginea sau specializarea, le poți adăuga aici --}}
                        <div>
                            <strong>Evenimente:</strong>
                            <ul>
                                @forelse ($speaker->events as $event)
                                    <li>{{ $event->title }}</li>
                                @empty
                                    <li>Nu sunt evenimente asociate acestui speaker.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <p>Nu există speakeri de afișat.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.speaker-layout>
