<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Partner;
use App\Models\Speaker;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Exemplu: Preia toate evenimentele pentru a le afișa în dashboard
        $events = Event::all();
        $sponsors = Sponsor::all();
        $speakers = Speaker::all();
        $partners = Partner::all();
        return view('admin.dashboard', compact('events', 'sponsors', 'speakers', 'partners'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

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

        return redirect()->route('admin.dashboard')->with('success', 'Evenimentul a fost creat cu succes.');
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
        return redirect()->route('admin.dashboard')->with('success', 'Evenimentul a fost șters cu succes.');
    }

    public function addSponsorForm(Event $event)
    {
        // Obține lista de sponsori care pot fi adăugați
        $sponsors = Sponsor::all();
        return view('admin.events.addSponsor', compact('event', 'sponsors'));
    }

    public function addSponsor(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'sponsor_id' => 'required|exists:sponsors,id', // Verifică dacă sponsorul există în baza de date
        ]);

        // Adaugă sponsorul la eveniment
        $sponsor = Sponsor::find($validatedData['sponsor_id']);
        $event->sponsors()->attach($sponsor);

        return redirect()->route('admin.dashboard')->with('success', 'Sponsorul a fost adăugat cu succes.');
    }

    public function removeSponsor(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'sponsor_id' => 'required|exists:sponsors,id', // Verifică dacă sponsorul există în baza de date
        ]);

        // Găsește sponsorul specificat
        $sponsor = Sponsor::find($validatedData['sponsor_id']);

        // Verifică dacă sponsorul este asociat cu evenimentul
        if ($event->sponsors()->find($sponsor->id)) {
            // Elimină asocierea dintre eveniment și sponsor
            $event->sponsors()->detach($sponsor);
            return redirect()->route('admin.dashboard')->with('success', 'Sponsorul a fost șters cu succes.');
        }

        // În cazul în care sponsorul nu este asociat cu evenimentul
        return redirect()->route('admin.dashboard')->with('error', 'Sponsorul nu este asociat cu acest eveniment.');
    }

    public function storeSponsors(Request $request, $eventId)
    {
        // Găsește evenimentul folosind ID-ul primit
        $event = Event::findOrFail($eventId);

        // Validare
        $validatedData = $request->validate([
            'sponsor_id' => 'required|exists:sponsors,id', // Asigură-te că sponsorul există
        ]);

        // Adaugă sponsorul la eveniment
        $event->sponsors()->attach($validatedData['sponsor_id']);

        // Redirecționează înapoi cu un mesaj de succes
        return back()->with('success', 'Sponsorul a fost adăugat cu succes la eveniment.');
    }

    public function destroySponsor($sponsorId)
    {
        $sponsor = Sponsor::findOrFail($sponsorId);
        $sponsor->delete();

        return back()->with('success', 'Sponsorul a fost șters cu succes.');
    }

    public function addPartnerForm(Event $event)
    {
        // Obține lista de parteneri care pot fi adăugați
        $partners = Partner::all();
        return view('admin.events.addPartner', compact('event', 'partners'));
    }

    public function addPartner(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'partner_id' => 'required|exists:partner,id', // Verifică dacă partenerul există în baza de date
        ]);

        // Adaugă partenerul la eveniment
        $partener = Partner::find($validatedData['partner_id']);
        $event->partners()->attach($partener);

        return redirect()->route('admin.dashboard')->with('success', 'Partenerul a fost adăugat cu succes.');
    }

    public function removePartner(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'partner_id' => 'required|exists:partner,id', // Verifică dacă partenerul există în baza de date
        ]);

        // Găsește partenerul specificat
        $partner = Partner::find($validatedData['partner_id']);

        // Verifică dacă partenerul este asociat cu evenimentul
        if ($event->partners()->find($partner->id)) {
            // Elimină asocierea dintre eveniment și partener
            $event->partners()->detach($partner);
            return redirect()->route('admin.dashboard')->with('success', 'Partenerul a fost șters cu succes.');
        }

        // În cazul în care partenerul nu este asociat cu evenimentul
        return redirect()->route('admin.dashboard')->with('error', 'Partenerul nu este asociat cu acest eveniment.');
    }

    public function storePartner(Request $request, $eventId)
    {
        // Găsește evenimentul folosind ID-ul primit
        $event = Event::findOrFail($eventId);

        // Validare
        $validatedData = $request->validate([
            'partner_id' => 'required|exists:partner,id', // Asigură-te că partenerul există
        ]);

        // Adaugă partenerul la eveniment
        $event->partners()->attach($validatedData['partner_id']);

        // Redirecționează înapoi cu un mesaj de succes
        return back()->with('success', 'Partenerul a fost adăugat cu succes la eveniment.');
    }

    public function destroyPartner($partnerId)
    {
        $partner = Partner::findOrFail($partnerId);
        $partner->delete();

        return back()->with('success', 'Partnerul a fost șters cu succes.');
    }
}
