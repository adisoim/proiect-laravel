<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Constructor pentru a adăuga middleware-ul de autentificare
    // Așa ne asigurăm că numai utilizatorii autentificați pot accesa aceste rute
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Afișarea listei de evenimente
    public function index()
    {
        $events = Event::all(); // Obținerea tuturor evenimentelor din baza de date
        return view('events.index', compact('events')); // Trimiterea evenimentelor la view
    }

    // Afișarea unei singure pagini de eveniment
    public function show(Event $event)
    {
        return view('events.show', compact('event')); // Trimiterea evenimentului individual la view
    }

    // Restul metodelor pentru CRUD, dacă sunt necesare
    // Dacă nu ai nevoie de crearea, editarea sau ștergerea evenimentelor din frontend,
    // aceste metode nu sunt necesare.

    // Crearea unui eveniment nou (pagina de formular)
    public function create()
    {
        return view('events.create');
    }

    // Stocarea unui eveniment nou în baza de date
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'location' => 'required',
            'ticket_price' => 'required|numeric',
            'date_time' => 'required|date',
        ]);

        Event::create($validatedData);

        return redirect()->route('events.index')->with('success', 'Evenimentul a fost creat cu succes.');
    }

    // Editarea unui eveniment existent (pagina de formular)
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Actualizarea unui eveniment în baza de date
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'location' => 'required',
            'ticket_price' => 'required|numeric',
            'date_time' => 'required|date',
        ]);

        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Evenimentul a fost actualizat cu succes.');
    }

    // Ștergerea unui eveniment din baza de date
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evenimentul a fost șters cu succes.');
    }
}
