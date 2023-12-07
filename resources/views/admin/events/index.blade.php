@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Evenimente</h1>
        @foreach ($events as $event)
            <div>
                <h2>{{ $event->name }}</h2>
                <p>Locație: {{ $event->location }}</p>
                <p>Preț Bilet: {{ $event->ticket_price }}</p>

                <a href="{{ route('events.edit', $event) }}">Editează</a>
                <form action="{{ route('events.destroy', $event) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Șterge</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
