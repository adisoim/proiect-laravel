<x-app-layout>
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Management Sponsori</h1>

    {{-- Formular pentru adăugarea unui nou sponsor --}}
    <form action="{{ route('sponsors.store') }}" method="POST">
        @csrf
        {{-- Adăugați câmpurile necesare aici --}}
        <button type="submit" class="btn btn-primary">Adaugă Sponsor</button>
    </form>

    {{-- Lista sponsorilor existenți pentru editare/ștergere --}}
    @foreach ($sponsors as $sponsor)
        <div>
            {{ $sponsor->name }}
            {{-- Adăugați butoane pentru editare și ștergere aici --}}
        </div>
    @endforeach
</div>
</x-app-layout>
