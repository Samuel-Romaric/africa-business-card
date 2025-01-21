<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'activity',
        'commercial_register',
        'nomber_of_offers',
        'is_blocked',
    ];

    function isBlocked() {
        if ($this->is_blocked == 1) {
            return true;
        }
        return false;
    }

    function hasProducts() {
        return $this->products()->exists();
    }

    function getTotalProduct() {
        $all = $this->products()->get();
        
        return count($all);
    }

    function getProducts() {
        return $this->products()->get();
    }

    function managers() {
        return $this->hasMany(Manager::class);
    }

    function products() {
        return $this->hasMany(Product::class);
    }

    function sales() {
        return $this->hasMany(Sale::class);
    }
}
