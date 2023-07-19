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
    ];


    //START RELATIONSHIPS
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function daily(){
        return $this->hasOne(Daily::class,'chair_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    //END RELATIONSHIPS
}
