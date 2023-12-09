<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::all();
        return view('agenda.index', compact('agenda'));
    }
    public function show(Agenda $agenda)
    {
        return view('agenda.show', compact('agenda'));
    }
    public function create()
    {
        return view('agendas.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'location' => 'required',
            'date_time' => 'required|date',
        ]);

        Agenda::create($validatedData);

        return redirect()->route('agendas.index')->with('success', 'Agenda a fost creata cu succes.');
    }
    public function edit(Agenda $agenda)
    {
        return view('agendas.edit', compact('agenda'));
    }
    public function update(Request $request, Agenda $agenda)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'location' => 'required',
            'date_time' => 'required|date',
        ]);

        $agenda->update($validatedData);

        return redirect()->route('agendas.index')->with('success', 'Agenda a fost actualizata cu succes.');
    }
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agendas.index')->with('success', 'Agenda a fost ștearsa cu succes.');
    }
}
