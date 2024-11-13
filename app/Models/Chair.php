<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    use HasFactory;
    protected $fillable = [
        'floor',
        'number',
        'status',
        'branch_id',
        'user_id',
        'customer_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function daily()
    {
        return $this->hasOne(Daily::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
