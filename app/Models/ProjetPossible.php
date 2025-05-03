<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetPossible extends Model
{
    protected $fillable = [
        'intitule',
        'nature',
        'description',
        'maquette_taches',
    ];

    protected $casts = [
        'maquette_taches' => 'array',
    ];
}
