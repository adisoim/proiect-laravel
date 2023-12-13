<x-layouts.cart-layout>
    <div class="container mx-auto p-4">
        @forelse ($cartItems as $item)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <div class="p-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    <h2 class="text-lg font-semibold col-span-3 md:col-span-4">{{ $item->ticket->name }}</h2>
                    <div class="col-span-4 md:col-span-3 flex items-center justify-start md:justify-center">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="border border-gray-300 rounded-md p-2 mr-2 w-16">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizează</button>
                        </form>
                    </div>
                    <p class="col-span-2 text-gray-600">Preț per Bilet: {{ number_format($item->ticket->price, 2) }} RON</p>
                    <p class="col-span-2 font-bold">Subtotal: {{ number_format($item->quantity * $item->ticket->price, 2) }} RON</p>
                    <div class="col-span-1 flex justify-end">
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Șterge</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600">Coșul tău este gol.</p>
        @endforelse

        @if($cartItems->isNotEmpty())
            <div class="text-right mt-6">
                <p class="text-xl font-bold mb-4">Total: {{ number_format($cartItems->sum(function($item) { return $item->quantity * $item->ticket->price; }), 2) }} RON</p>
                <a href="{{ route('cart.checkout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg text-lg">Finalizează Comanda</a>
            </div>
        @endif
    </div>
</x-layouts.cart-layout>
