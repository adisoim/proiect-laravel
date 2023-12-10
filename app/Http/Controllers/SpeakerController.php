<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $speakers = Speaker::all();
        return view('speakers.index', compact('speakers'));
    }
    public function show(Speaker $speaker)
    {
        return view('speakers.show', compact('speaker'));
    }
    public function create()
    {
        return view('speakers.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Speaker::create($validatedData);

        return redirect()->route('speakers.index')->with('success', 'Speaker-ul a fost creat cu succes.');
    }
    public function edit(Speaker $speaker)
    {
        return view('speakers.edit', compact('speaker'));
    }
    public function update(Request $request, Speaker $speaker)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $speaker->update($validatedData);

        return redirect()->route('speakers.index')->with('success', 'Speaker-ul a fost actualizat cu succes.');
    }
    public function destroy(Speaker $speaker)
    {
        $speaker->delete();

        return redirect()->route('speakers.index')->with('success', 'Speaker-ul a fost șters cu succes.');
    }
}
