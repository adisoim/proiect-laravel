<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panoul de Control al Administratorului') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Link-uri Rapide pentru Gestionarea Evenimentelor și Utilizatorilor -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a href="{{ route('admin.events.index') }}" class="btn">Gestionează Evenimentele</a>
                    {{-- <a href="{{ route('admin.users.index') }}" class="btn">Gestionează Utilizatorii</a> --}}
                    <!-- Alte link-uri utile -->
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
