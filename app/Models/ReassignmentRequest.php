<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReassignmentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'requester_emp_code',
        'requested_to_emp_code',
        'status',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_emp_code', 'emp_code');
    }

    public function requestedTo()
    {
        return $this->belongsTo(User::class, 'requested_to_emp_code', 'emp_code');
    }
}
