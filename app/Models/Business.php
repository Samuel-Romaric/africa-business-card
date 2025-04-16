<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Business extends Model implements HasMedia
{
    use InteractsWithMedia;
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

    // function hasOffers() {
    //     return $this->offers()->exists();
    // }

    function getTotalOffer() {
        $offers = $this->offers()->get();
        
        return count($offers);
    }

    function offers() {
        return $this->hasMany(Offer::class);
    }

    function sales() {
        return $this->hasMany(Sale::class);
    }

    function user() {
        return $this->hasOne(User::class);
    }

    function getActivitySector() {
        $user = $this->user;
        $activitySector = $user->activitySector()->first();
        
        return $activitySector;
    }

    function getActivitySectorTitle() {
        $activitySector = $this->getActivitySector();

        return $activitySector->titre;
    }

    function getSubActivitySector() {
        $sector = $this->getActivitySector();
        // dd($sector->subSectors()->first());
        // return $sector->subSectors()->get();
        $subSector = $sector->subSectors()->first();
        return $subSector;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('businessLogo')
            ->singleFile();
    }

    public function getBusinessLogoFullUrl()
    {
        if (is_null($this->getFirstMedia('businessLogo'))) {
            return asset('/admin/assets/img/logo-business.png');
        }

        return $this->getFirstMedia('businessLogo')->getFullUrl();
    }
}
