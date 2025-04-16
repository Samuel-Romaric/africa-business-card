<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySector extends Model
{
    //

    function users() {
        return $this->hasMany(User::class);
    }

    function subSectors() {
        return $this->hasMany(ActivitySubSector::class, 'activity_sectors_id');
    }
}
