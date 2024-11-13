<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'check_in',
        'check_out',
        'user_id',
        'status',
    ];
    //START RELATIONSHIPS
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function chair()
    {
        return $this->belongsTo(Chair::class, 'chair_id');
    }
    //END RELATIONSHIPS
}
