<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'trade';

    protected $fillable = [
        'product_id',
        'name_product',
        'quantity',
        'price',
        'type_product',
        'trade_date',
        'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
