<x-layouts.cart-layout>
    @forelse ($cartItems as $item)
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4 p-4">
            <h2 class="text-lg font-semibold">{{ $item->ticket->title }}</h2>
            <p>Cantitate: {{ $item->quantity }}</p>
            <p>Preț per Bilet: {{ $item->ticket->price }}</p>
            <p>Subtotal: {{ $item->quantity * $item->ticket->price }}</p>
            <!-- Buton pentru eliminarea articolului din coș -->
            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">Șterge</button>
            </form>
        </div>
    @empty
        <p>Nu există articole în coș.</p>
    @endforelse
    @if($cartItems->isNotEmpty())
        <a href="{{ route('checkout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Finalizează Comanda</a>
    @endif
</x-layouts.cart-layout>
