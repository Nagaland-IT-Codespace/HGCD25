<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationMaster extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function district()
    {
        return $this->hasOne(DistrictMaster::class, 'id', 'district_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'location_id', 'id');
    }
}
