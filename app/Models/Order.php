<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

        protected $fillable = [
        'quantity',
        'price',
        'cost',
        'date_delivery',
        'buy_verification_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function buyVerification()
    {
        return $this->hasOne(BuyVerification::class);
    }
}