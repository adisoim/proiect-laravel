<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Ticket;
use App\Models\Cart;

class CartController extends Controller
{
    // Afisează coșul de cumpărături
    public function index()
    {
        // Presupunând că fiecare utilizator are un singur coș asociat
        $cart = Cart::where('user_id', auth()->id())->first();

        // Dacă coșul există, obține articolele din coș
        $cartItems = $cart ? $cart->items()->with('ticket')->get() : collect();

        return view('cart.index', compact('cartItems'));
    }

    // Adaugă un articol în coș
    public function add(Request $request, $ticketId)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $ticket = Ticket::findOrFail($ticketId);

        // Verifică dacă articolul există deja în coș
        $cartItem = $cart->items()->where('ticket_id', $ticket->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity'); // Incrementează cantitatea dacă articolul există deja
        } else {
            $cart->items()->create([
                'ticket_id' => $ticket->id,
                'quantity' => 1 // Presupunem că adăugăm un singur bilet
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Articolul a fost adăugat în coș.');
    }

    // Actualizează un articol în coș
    public function update(Request $request, CartItem $cartItem)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
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

    public function checkout()
    {
        // Presupunând că fiecare utilizator are un singur coș asociat
        $cart = Cart::where('user_id', auth()->id())->first();

        // Dacă coșul există, obține articolele din coș
        $cartItems = $cart ? $cart->items()->with('ticket')->get() : collect();

        // Calcul total pentru articolele din coș
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->ticket->price;
        });

        // Returnează view-ul pentru pagina de checkout cu articolele și totalul
        return view('cart.checkout', compact('cartItems', 'total'));
    }

}
