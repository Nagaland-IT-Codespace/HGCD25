<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoVerification extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function assignment()
    {
        return $this->hasOne(Assignment::class, 'id', 'assignment_id');
    }

    public function verifiedBy()
    {
        return $this->hasOne(User::class, 'id', 'verified_by');
    }
}
