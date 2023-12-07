@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Adaugă un Eveniment Nou</h1>
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">Titlu:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="location">Locație:</label>
                <input type="text" name="location" id="location" required>
            </div>
            <div>
                <label for="ticket_price">Preț Bilet:</label>
                <input type="number" name="ticket_price" id="ticket_price" required>
            </div>
            <button type="submit">Salvează Evenimentul</button>
        </form>
    </div>
@endsection
