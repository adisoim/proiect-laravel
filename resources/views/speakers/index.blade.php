<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Management Speakeri</h1>

        {{-- Formular pentru adăugarea unui nou speaker --}}
        <form action="{{ route('speakers.store') }}" method="POST">
            @csrf
            {{-- Adăugați câmpurile necesare aici --}}
            <button type="submit" class="btn btn-primary">Adaugă Speaker</button>
        </form>

        {{-- Lista speakerilor existenți pentru editare/ștergere --}}
        @foreach ($speakers as $speaker)
            <div>
                {{ $speaker->name }}
                {{-- Adăugați butoane pentru editare și ștergere aici --}}
            </div>
        @endforeach
    </div>
</x-app-layout>
