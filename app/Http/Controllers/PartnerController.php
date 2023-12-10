<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $partners = Partner::all();
        return view('partners.index', compact('partners'));
    }
    public function show(Partner $partner)
    {
        return view('partners.show', compact('partner'));
    }
    public function create()
    {
        return view('partners.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Partner::create($validatedData);

        return redirect()->route('partners.index')->with('success', 'Partenerul a fost creat cu succes.');
    }
    public function edit(Partner $partner)
    {
        return view('partners.edit', compact('partner'));
    }
    public function update(Request $request, Partner $partner)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $partner->update($validatedData);

        return redirect()->route('partners.index')->with('success', 'Partenerul a fost actualizat cu succes.');
    }
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partenerul a fost șters cu succes.');
    }
}
