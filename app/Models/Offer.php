<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

        protected $fillable = [
        'title',
        'type_offer',
        'discount',
        'description',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
