@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editare Eveniment: {{ $event->title }}</h1>
        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Titlu:</label>
                <input type="text" name="title" id="title" value="{{ $event->title }}" required>
            </div>
            <div>
                <label for="location">Locație:</label>
                <input type="text" name="location" id="location" value="{{ $event->location }}" required>
            </div>
            <div>
                <label for="ticket_price">Preț Bilet:</label>
                <input type="number" name="ticket_price" id="ticket_price" value="{{ $event->ticket_price }}" required>
            </div>
            <button type="submit">Actualizează Evenimentul</button>
        </form>
    </div>
@endsection
