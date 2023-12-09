<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sponsors = Sponsor::all();
        return view('sponsors.index', compact('sponsors'));
    }

    public function create()
    {
        return view('sponsors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            // Alte câmpuri necesare pentru sponsor
        ]);

        Sponsor::create($validatedData);

        return redirect()->route('sponsors.index')->with('success', 'Sponsorul a fost creat cu succes.');
    }

    public function show(Sponsor $sponsor)
    {
        return view('sponsors.show', compact('sponsor'));
    }

    public function edit(Sponsor $sponsor)
    {
        return view('sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'website' => 'nullable'
            // Alte câmpuri necesare pentru sponsor
        ]);

        $sponsor->update($validatedData);

        return redirect()->route('sponsors.index')->with('success', 'Sponsorul a fost actualizat cu succes.');
    }

    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();

        return redirect()->route('sponsors.index')->with('success', 'Sponsorul a fost șters cu succes.');
    }
}
