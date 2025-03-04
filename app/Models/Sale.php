<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = [
        'code',
        'montant_recu',
        'prix',
        'quantite',
        'nom_client',
        'nom_marchand',
        'offer_id',
        'business_id',
        'manager_id',
        'admin_id',
    ];

    function offer() {
        return $this->belongsTo(Offer::class);
    }

    function business() {
        return $this->belongsTo(Business::class);
    }

    function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }

    function getManagerFullName() {
        if ($this->manager()->exists()) {
            $fullName = $this->manager->name.' '.$this->manager->firstname;

            return $fullName;
        }

        return '-';
    }

    function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
