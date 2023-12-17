<x-app-layout>
    <main class="mt-5">
        @php
            $now = \Carbon\Carbon::now();
        @endphp

        @foreach($events->sortBy('date_time')->groupBy(function($event) {
            return \Carbon\Carbon::parse($event->date_time)->format('Y-m-d');
        }) as $date => $eventsOnDate)
            @php
                $dateCarbon = \Carbon\Carbon::parse($date);
            @endphp
            @if ($dateCarbon->isToday() || $dateCarbon->isFuture())
                <div class="container mx-auto p-4 mb-6">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                        <h3 class="text-xl font-semibold p-4">{{ $dateCarbon->format('l, F j, Y') }}</h3>
                        @foreach($eventsOnDate as $event)
                            <div class="agenda-event p-4 border-t border-gray-200">
                                <h4 class="text-2xl font-bold mb-2">{{ $event->title }}</h4>
                                <p>{{ $event->description }}</p>
                                <p>{{ $event->location }}</p>
                                <p>{{ $event->date_time }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </main>
</x-app-layout>
