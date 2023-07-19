<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;
    protected $fillable=[
        'start_time',
        'end_time',
        'duration',
        'user_id'
    ];
    //START RELATIONSHIPS
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function chair(){
        return $this->belongsTo(Chair::class,'chair_id');
    }
    //END RELATIONSHIPS
}
