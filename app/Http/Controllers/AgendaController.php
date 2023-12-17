<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Event;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $events = Event::orderBy('date_time', 'asc')->get();

        return view('agendas.index', compact('events'));
    }
}
