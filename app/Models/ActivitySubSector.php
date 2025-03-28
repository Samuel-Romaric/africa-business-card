<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySubSector extends Model
{
    //

    function sectorActivity() {
        return $this->belongsTo(ActivitySector::class);
    }
}
