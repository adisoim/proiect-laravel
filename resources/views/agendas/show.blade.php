<x-layouts.agenda-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $agenda->title }}</h1>

        <div class="container mx-auto p-4">
            <p>{{ $agenda->description }}</p>
            <p>Locație: {{ $agenda->location }}</p>
            <p>Data și Ora: {{ $agenda->date_time }}</p>
        </div>

    </div>
</x-layouts.agenda-layout>
