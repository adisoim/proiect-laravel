<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    private function getTotalSum($userId)
    {
        $cart = Cart::where('user_id', $userId)->with('items.ticket')->first();
        if (!$cart) return 0;

        return $cart->items->sum(function ($item) {
                return $item->quantity * $item->ticket->price;
            }) * 100; // Înmulțește cu 100 pentru a converti în cenți
    }

    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $totalAmount = $this->getTotalSum($request->user()->id);

        $paymentIntent = PaymentIntent::create([
            'amount' => $totalAmount,
            'currency' => 'ron',
        ]);

        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }


    public function confirmCheckout(Request $request)
    {
        $billingDetails = $request->input('billingDetails');
        // Procesați și stocați detaliile de facturare aici

        // Codul existent pentru golirea coșului și confirmarea plății
        $cart = Cart::where('user_id', auth()->id())->first();
        $cart->items()->delete();

        return response()->json(['status' => 'success'], 200);
    }


}
