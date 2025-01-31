<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    //
    protected $fillable = [
        'name',
        'slug',
        'quantity',
        'price',
    ];

    function manager() {
        return $this->belongsTo(Manager::class);
    }
    
    function business() {
        return $this->belongsTo(Business::class);
    }

    function sales() {
        return $this->hasMany(Sale::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('coverProduct')
            ->singleFile();
    }

    public function getCoverProductFullUrl()
    {
        if (is_null($this->getFirstMedia('coverProduct'))) {
            return asset('/admin/assets/img/prod-2.jpg');
        }

        return $this->getFirstMedia('coverProduct')->getFullUrl();
    }
}
