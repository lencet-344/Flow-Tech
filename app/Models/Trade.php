<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'trades';

        protected $fillable = [
        'name',
        'quantity',
        'price',
        'type_product',
        'date_trade',
        'description',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
