{{-- layout pentru parteneri --}}
<x-layouts.partner-layout>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($partners as $partner)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $partner->name }}</h2>
                        <p>{{ $partner->description }}</p>
                        {{-- Adaugă aici alte detalii relevante despre partener, cum ar fi website-ul sau imaginea --}}
                        <div>
                            <strong>Evenimente asociate:</strong>
                            <ul>
                                @forelse ($partner->events as $event)
                                    <li>{{ $event->title }}</li>
                                @empty
                                    <li>Nu sunt evenimente asociate acestui partener.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <p>Nu există parteneri de afișat.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.partner-layout>
