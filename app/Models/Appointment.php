<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'mobile',
        'chair_id',
        'branch_id',
        'appointment_date',
        'start_at',
        'end_at',
        'status',
    ];

    public function chair()
    {
        return $this->belongsTo(Chair::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
