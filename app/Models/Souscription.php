<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre_offre',
        'reseau',
        'montant',
        'quantite',
        'mode_paiement',
        'status',
    ];
}
