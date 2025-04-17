<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;
    protected $table = 'weathers';   // ← força plural

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'city',
        'temperature',
        'humidity',
        'condition',
        'fetched_at',
    ];

    /**
     * Casts para garantir tipos corretos ao acessar os atributos.
     */
    protected $casts = [
        'temperature' => 'float',
        'humidity'    => 'integer',
        'fetched_at'  => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
