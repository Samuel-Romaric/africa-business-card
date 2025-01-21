<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = [
        'code',
        'amount_received',
        'product_id',
        'business_id',
        'manager_id',
    ];

    function product() {
        return $this->belongsTo(Product::class);
    }

    function business() {
        return $this->belongsTo(Business::class);
    }

    function manager() {
        return $this->belongsTo(Manager::class);
    }
}
