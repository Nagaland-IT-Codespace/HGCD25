<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'employee_id', 'id');
    }

    public function currentAssignment()
    {
        return $this->hasOne(Assignment::class, 'employee_id', 'id')->latestOfMany();
    }
}
