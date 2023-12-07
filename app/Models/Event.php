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
        // 'sponsors',
        // 'speakers',
        // 'partners',
    ];

    protected $dates = [
      'date_time',
    ];

//    public function speakers()
//    {
//        return $this->hasMany(Speaker::class);
//    }

}
