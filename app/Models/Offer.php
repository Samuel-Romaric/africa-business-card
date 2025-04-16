<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Offer extends Model implements HasMedia
{
    use InteractsWithMedia;
    //
    protected $fillable = [
        'titre',
        'slug',
        'type',
        'quantite',
        'price',
        'description',
        'business_id',
        'user_id',
        'validated',
        'validated_at',
        'validated_by',
        'created_by',
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function business() : BelongsTo {
        return $this->belongsTo(Business::class);
    }

    function sales() {
        return $this->hasMany(Sale::class);
    }

    function createBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function validateBy() {
        return $this->belongsTo(User::class, 'validated_by');
    }

    function isValidated() {
        
        if ($this->validated == 1) {
            return true;
        }

        return false;
    }

    function getStatus() {
        if ($this->validated == 1) {
            return 'validé';
        }

        return 'en attente';
    }

    function getStatusClass() {
        if ($this->isValidated()) {
            return 'status-success';
        }

        return 'status-warning';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('coverOffer')
            ->singleFile();
    }

    public function getCoverOfferFullUrl()
    {
        if (is_null($this->getFirstMedia('coverOffer'))) {
            return asset('/admin/assets/img/prod-2.jpg');
        }

        return $this->getFirstMedia('coverOffer')->getFullUrl();
    }

}
