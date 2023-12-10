<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Management Parteneri</h1>

        {{-- Formular pentru adăugarea unui nou partener --}}
        <form action="{{ route('partners.store') }}" method="POST">
            @csrf
            {{-- Adăugați câmpurile necesare aici --}}
            <button type="submit" class="btn btn-primary">Adaugă Partener</button>
        </form>

        {{-- Lista speakerilor existenți pentru editare/ștergere --}}
        @foreach ($partners as $partner)
            <div>
                {{ $partner->name }}
                {{-- Adăugați butoane pentru editare și ștergere aici --}}
            </div>
        @endforeach
    </div>
</x-app-layout>
