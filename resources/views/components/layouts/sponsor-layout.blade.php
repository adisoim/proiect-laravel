<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sponsori') }}
        </h2>
    </x-slot>
    <main>
        {{ $slot }}
    </main>
</x-app-layout>