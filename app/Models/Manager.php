<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Manager extends Model implements HasMedia
{
    use InteractsWithMedia;
    //
    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
    ];

    function products() {
        return $this->hasMany(Product::class);
    }
    
    function business() {
        return $this->belongsTo(Business::class);
    }

    function sales() {
        return $this->hasMany(Sale::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function getCoverFullUrl()
    {
        if (is_null($this->getFirstMedia('cover'))) {
            return asset('admin/assets/img/cover.png');
        }

        return $this->getFirstMedia('cover')->getFullUrl();
    }

}
