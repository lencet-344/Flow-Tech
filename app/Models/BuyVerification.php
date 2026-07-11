<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuyVerification extends Model
{
    use HasFactory;

    protected $table = 'buy_verification';

        protected $fillable = [
        'quantity',
        'date_buy',
        'iva',
        'cost_total',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
