<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Ticket;
use App\Models\Cart;

class CartController extends Controller
{
    // Afisează coșul de cumpărături
    public function index()
    {
        $cartItems = CartItem::with('ticket')->get(); // Presupunând că CartItem are o relație cu Ticket
        return view('cart.index', compact('cartItems'));
    }

    // Adaugă un articol în coș
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|min:1'
        ]);

        $cartItem = CartItem::create([
            'ticket_id' => $validatedData['ticket_id'],
            'quantity' => $validatedData['quantity'],
            // 'cart_id' => $cartId // Adaugă ID-ul coșului aici, dacă este necesar
        ]);

        return redirect()->route('cart.index')->with('success', 'Articolul a fost adăugat în coș.');
    }

    // Actualizează un articol în coș
    public function update(Request $request, CartItem $cartItem)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|min:1'
        ]);

        $cartItem->update([
            'quantity' => $validatedData['quantity']
        ]);

        return redirect()->route('cart.index')->with('success', 'Articolul a fost actualizat în coș.');
    }

    // Elimină un articol din coș
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Articolul a fost eliminat din coș.');
    }

    // Pagina de checkout
    public function checkout()
    {
        // Logică pentru afișarea paginii de checkout
        return view('cart.checkout');
    }

    public function add(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
    
        if ($event->ticket) {
            $ticket = $event->ticket->first();
    
            if ($ticket) {
                // Adaugă biletul în coș
                $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
                $cartItem = CartItem::firstOrCreate([
                    'cart_id' => $cart->id,
                    'ticket_id' => $ticket->id
                ], [
                    'quantity' => 0
                ]);
    
                $cartItem->increment('quantity'); // Adaugă un bilet
                $cartItem->save();
    
                return redirect()->route('cart.index')->with('success', 'Biletul a fost adăugat în coș!');
            }
        }
    
        return redirect()->route('cart.index')->with('error', 'Nu există bilete disponibile pentru acest eveniment.');
    }

}
