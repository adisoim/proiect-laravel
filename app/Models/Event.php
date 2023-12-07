<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'ticket_price',
        'date_time',
        // 'sponsors',
        // 'speakers',
        // 'partners',
    ];

//    public function speakers()
//    {
//        return $this->hasMany(Speaker::class);
//    }

}
