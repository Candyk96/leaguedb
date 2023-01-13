<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'league',
        'tier',
        'round',
        'track',
        'qualifying_position',
        'race_position',
        'penalties',
        'game',
        'date',
        'details',
        
    ];
}
