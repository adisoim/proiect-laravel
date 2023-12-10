<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'ticket_id', 'quantity'];

    // Relație cu Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relație cu Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}