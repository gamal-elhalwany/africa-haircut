<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
//        'user_id'
    ];




    //START RELATIONSHIPS
    public function users(){
        return $this->hasMany(User::class,'branch_id');
    }
    public function products(){
        return $this->hasMany(Product::class,'branch_id');
    }
    public function chairs(){
        return $this->hasMany(Chair::class,'branch_id');
    }
    //END RELATIONSHIPS

}
