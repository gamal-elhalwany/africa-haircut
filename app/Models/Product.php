<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'buy_price',
        'sell_price',
        'customer_price',
        'distribution_value',
        'quantity',
        'value',
        'net_profit',
        'status',
        'branch_id',
    ];


    //START RELATIONSHIPS
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //END RELATIONSHIPS
}
