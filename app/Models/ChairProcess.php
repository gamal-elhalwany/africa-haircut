<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChairProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'chair_id',
        'user_id',
        'customer_id',
        'check_in',
        'check_out',
    ];

    public function chair()
    {
        return $this->belongsTo(Chair::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for calculating the duration
    public function getDurationAttribute()
    {
        if ($this->check_in && $this->check_out) {
            return $this->check_in->diffInMinutes($this->check_out);
        }

        return null; // Return null if check_in or check_out is missing.
    }

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];
}
