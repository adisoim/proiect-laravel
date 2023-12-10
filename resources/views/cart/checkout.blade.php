<x-layouts.cart-layout>
    <h1 class="text-2xl font-bold mb-4">Finalizare Comandă</h1>
    <form action="{{ route('checkout.confirm') }}" method="POST">
        @csrf
        <!-- Detalii de plată, adresa etc. -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4 p-4">
            <h2 class="text-lg font-semibold">Detalii Plată</h2>
            <!-- Câmpuri pentru detaliile de plată -->
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Confirmă Comanda</button>
    </form>
</x-layouts.cart-layout>
