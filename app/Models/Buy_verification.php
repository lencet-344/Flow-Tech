<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buy_verification extends Model
{
    use HasFactory;

    protected $table = 'buy_verifications';

    protected $fillable = [
        'quantity',
        'date_buy',
        'iva',
        'cost_total',
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'buy_verifications_id');
    }
}
