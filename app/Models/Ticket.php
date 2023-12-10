<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'event_id']; // Adaugă alte atribute necesare

    // Relație cu Event, presupunând că fiecare bilet este asociat unui eveniment
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relație cu CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
