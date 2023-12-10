<x-layouts.partner-layout>
    <div class="container mx-auto p-4">

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
</x-layouts.partner-layout>
