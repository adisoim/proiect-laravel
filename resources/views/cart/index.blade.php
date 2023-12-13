<x-layouts.cart-layout>
    <div class="container mx-auto p-4">

        @forelse ($cartItems as $item)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="p-4 grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <h2 class="text-lg font-semibold col-span-1 md:col-span-2">{{ $item->ticket->title }}</h2>
                    <p class="text-gray-600">Cantitate: {{ $item->quantity }}</p>
                    <p class="text-gray-600">Preț per Bilet: {{ number_format($item->ticket->price, 2) }} RON</p>
                    <p class="font-bold">Subtotal: {{ number_format($item->quantity * $item->ticket->price, 2) }} RON</p>
                </div>
                <div class="px-4 py-3 bg-gray-100 text-right">
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Șterge</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600">Coșul tău este gol.</p>
        @endforelse

        @if($cartItems->isNotEmpty())
            <div class="text-right mt-6">
                <a href="{{ route('cart.checkout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg text-lg">Finalizează Comanda</a>
            </div>
        @endif
    </div>
</x-layouts.cart-layout>
