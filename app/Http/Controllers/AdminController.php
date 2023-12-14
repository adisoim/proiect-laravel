<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Partner;
use App\Models\Speaker;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|max:2048',
        ]);

        // Verifica dacă o imagine a fost încărcată
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }

        Event::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Evenimentul a fost creat cu succes.');
    }


    public function edit(Event $event)
    {
        $event = Event::with(['sponsors', 'speakers', 'partners'])->findOrFail($event->id);
        $sponsors = Sponsor::all();
        $speakers = Speaker::all();
        $partners = Partner::all();

        return view('admin.events.edit', compact('event','sponsors', 'speakers', 'partners' ));
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
    public function addSpeakerForm(Event $event)
    {
        // Obține lista de speakeri care pot fi adăugați
        $speakers = Speaker::all();
        return view('admin.events.addSpeakers', compact('event', 'speakers'));
    }

    public function addSpeaker(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'speaker_id' => 'required|exists:speaker,id', // Verifică dacă speakerul există în baza de date
        ]);

        // Adaugă speakerul la eveniment
        $speaker = Speaker::find($validatedData['speaker_id']);
        $event->speakers()->attach($speaker);

        return redirect()->route('admin.dashboard')->with('success', 'Speaker-ul a fost adăugat cu succes.');
    }

    public function removeSpeaker(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'speaker_id' => 'required|exists:speaker,id', // Verifică dacă speakerul există în baza de date
        ]);

        // Găsește speakerul specificat
        $speaker = Speaker::find($validatedData['speaker_id']);

        // Verifică dacă speakerul este asociat cu evenimentul
        if ($event->speakers()->find($speaker->id)) {
            // Elimină asocierea dintre eveniment și speaker
            $event->speakers()->detach($speaker);
            return redirect()->route('admin.dashboard')->with('success', 'Speaker-ul a fost șters cu succes.');
        }

        // În cazul în care speakerul nu este asociat cu evenimentul
        return redirect()->route('admin.dashboard')->with('error', 'Speaker-ul nu este asociat cu acest eveniment.');
    }

    public function storeSpeaker(Request $request, $speakerId)
    {
        // Găsește evenimentul folosind ID-ul primit
        $event = Event::findOrFail($speakerId);

        // Validare
        $validatedData = $request->validate([
            'speaker_id' => 'required|exists:speaker,id', // Asigură-te că speakerul există
        ]);

        // Adaugă speakerul la eveniment
        $event->speakers()->attach($validatedData['speaker_id']);

        // Redirecționează înapoi cu un mesaj de succes
        return back()->with('success', 'Speaker-ul a fost adăugat cu succes la eveniment.');
    }

    public function destroySpeaker($speakerId)
    {
        $speaker = Partner::findOrFail($speakerId);
        $speaker->delete();

        return back()->with('success', 'Speaker-ul a fost șters cu succes.');
    }
}
