<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];




    //START RELATIONSHIPS
    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'branch_id');
    }

    public function chairs()
    {
        return $this->hasMany(Chair::class, 'branch_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
