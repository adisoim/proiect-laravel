<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index()
   {
       // Exemplu: Preia toate evenimentele pentru a le afișa în dashboard
       $events = Event::all();
       return view('admin.dashboard', compact('events'));
   }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        // Validează datele de intrare
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'location' => 'required',
            'ticket_price' => 'required|numeric',
        ]);

        // Creează un nou eveniment
        Event::create($validatedData);

        // Redirecționează înapoi la lista de evenimente cu un mesaj de succes
        return redirect()->route('admin.events.index')->with('success', 'Evenimentul a fost adăugat cu succes.');
    }

    public function edit(Event $event)
    {
        // Returnează view-ul pentru editarea evenimentului
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // Validează datele de intrare
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'location' => 'required',
            'ticket_price' => 'required|numeric',
        ]);

        // Actualizează evenimentul
        $event->update($validatedData);

        // Redirecționează înapoi la lista de evenimente cu un mesaj de succes
        return redirect()->route('admin.events.index')->with('success', 'Evenimentul a fost actualizat cu succes.');
    }

    public function destroy(Event $event)
    {
        // Șterge evenimentul
        $event->delete();

        // Redirecționează înapoi la lista de evenimente cu un mesaj de succes
        return redirect()->route('admin.events.index')->with('success', 'Evenimentul a fost șters cu succes.');
    }
}
