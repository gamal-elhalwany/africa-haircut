<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChairProcess extends Model
{
    use HasFactory;

    protected $fillable=[
        'chair_id',
        'user_id',
        'customer_id',
        'cost',
    ];
}
