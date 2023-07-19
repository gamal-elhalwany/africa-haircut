<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'national_id',
        'emp_id',
        'hiring_date',
        'job_id',
        'salary_system',
        'salary',
        'commotion',
        'work_days',
        'work_hours',
        'gender',
        'branch_id',
    ];



    //START RELATIONSHIPS
     public function branch(){
         return $this->belongsTo(Branch::class,'branch_id');
     }
    public function products(){
        return $this->hasMany(Product::class,'user_id');
    }
    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
    public function daily(){
        return $this->hasOne(Daily::class,'user_id');
    }
    public function chair(){
        return $this->hasOne(Chair::class,'user_id');
    }
    //END RELATIONSHIPS

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
