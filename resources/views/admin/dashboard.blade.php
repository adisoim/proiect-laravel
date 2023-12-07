@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Panoul de Control al Administratorului</h1>

        <!-- Statistici Generale -->
        <div class="stats my-4">
            <div class="stat">
                <div class="stat-title">Număr Total Evenimente</div>
                <div class="stat-value">10</div>
                <!-- Aici poți include logica pentru a afișa numărul real de evenimente -->
            </div>
            <div class="stat">
                <div class="stat-title">Utilizatori Înregistrați</div>
                <div class="stat-value">50</div>
                <!-- Similar, pentru numărul de utilizatori -->
            </div>
            <!-- Alte statistici -->
        </div>

        <!-- Link-uri rapide pentru gestionarea evenimentelor, utilizatorilor etc. -->
        <div class="quick-links my-4">
            <a href="{{ route('admin.events.index') }}" class="btn">Gestionează Evenimentele</a>
{{--            <a href="{{ route('admin.users.index') }}" class="btn">Gestionează Utilizatorii</a>--}}
            <!-- Alte link-uri utile -->
        </div>

        <!-- Alte componente specifice pentru admin -->
    </div>
@endsection
