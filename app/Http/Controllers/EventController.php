<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
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
        return view('admin.events.create');
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
            'image' => 'required|image|max:2048',
        ]);

        // Verifica dacă o imagine a fost încărcată
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }

        // Crează evenimentul
        $event = Event::create($validatedData);

        // Crează biletul asociat cu evenimentul
        $ticket = new Ticket([
            'event_id' => $event->id,
            'price' => $validatedData['ticket_price'],
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


    public function locations()
    {
        $eventsByLocation = Event::all()->groupBy('location');
        return view('locations', compact('eventsByLocation'));
    }
}
