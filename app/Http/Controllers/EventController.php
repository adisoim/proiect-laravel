<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
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
        $events = Event::with('sponsors')->get(); // Obținerea tuturor evenimentelor din baza de date
        return view('events.index', compact('events')); // Trimiterea evenimentelor la view
    }

    // Afișarea unei singure pagini de eveniment
    public function show(Event $event)
    {
        return view('events.show', compact('event')); // Trimiterea evenimentului individual la view
    }

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
            'ticket_price' => 'required|numeric', // Asigură-te că ai un câmp pentru prețul biletului
            'date_time' => 'required|date',
        ]);

        $event = Event::create($validatedData);

        // Crează un bilet asociat cu evenimentul
        $ticket = new Ticket([
            'event_id' => $event->id,
            'price' => $request->input('ticket_price'),
            // alte atribute necesare
        ]);
        $ticket->save();

        return redirect()->route('admin.dashboard')->with('success', 'Evenimentul și biletul au fost create cu succes.');
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

    public function addSponsor(Request $request, Event $event)
    {
        $event->sponsors()->attach($request->sponsor_id);
        return back()->with('success', 'Sponsor adăugat la eveniment.');
    }
}
