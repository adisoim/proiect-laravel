<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'website',

    ];

    // dacă un sponsor poate avea mai multe evenimente
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
