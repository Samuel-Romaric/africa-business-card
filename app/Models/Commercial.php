<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Commercial extends Model implements HasMedia
{
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'diplome',
        'age',
        'region',
        'departement',
        'commune',
        'description'
    ];

    function user() {
        return $this->hasOne(User::class);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function getAvatarFullUrl()
    {
        $link = $this->user->getAvatarFullUrl();

        return $link;
    }

    public function activitySector()
    {
        return $this->belongsTo(ActivitySector::class, 'activity_sector_id');
    }
}
