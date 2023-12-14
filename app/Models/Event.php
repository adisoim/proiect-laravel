<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'ticket_price',
        'date_time',
        'image',
        // 'sponsors',
        // 'speakers',
        // 'partners',
    ];

    public function ticket()
    {
    return $this->hasOne(Ticket::class);
    }


    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function partners():BelongsToMany
    {
        return $this->belongsToMany(Partner::class);
    }

    protected static function booted()
    {
        static::created(function ($event) {
            $event->ticket()->create([
                'name' => 'Bilet pentru ' . $event->title,
                'price' => $event->ticket_price,
            ]);
        });
    }
}
