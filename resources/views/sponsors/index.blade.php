<x-layouts.sponsor-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Sponsori</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($sponsors as $sponsor)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $sponsor->name }}</h2>
                        <p>{{ $sponsor->description }}</p>
                        <p>Website: <a href="{{ $sponsor->website }}" class="text-blue-600 hover:text-blue-800">{{ $sponsor->website }}</a></p>
                        <div>
                            <strong>Evenimente asociate:</strong>
                            <ul>
                                @forelse ($sponsor->events as $event)
                                    <li>{{ $event->title }}</li>
                                @empty
                                    <li>Nu sunt evenimente asociate.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <p>Nu există sponsori de afișat.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.sponsor-layout>
