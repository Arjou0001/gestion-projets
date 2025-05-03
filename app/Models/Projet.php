<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'duree',
        'budget',
        'nombre_personnes',
        'entreprise_id',
        'projet_possible_id',
        'is_active',
    ];


    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    // Dans le modèle Projet
    public function projetPossible()
    {
        return $this->belongsTo(ProjetPossible::class);
    }

    
    
}