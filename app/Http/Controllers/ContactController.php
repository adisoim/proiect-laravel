<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//    public function index()
//    {
//        $contacts = Contact::all();
//        return view('contacts.index', compact('contacts'));
//    }
    public function create()
    {
        return view('contacts.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);
        Contact::create($validatedData);

        return redirect()->route('contacts.create')->with('success', 'Datele au fost trimise cu succes.');
    }
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Contactul a fost șters cu succes.');
    }
}
