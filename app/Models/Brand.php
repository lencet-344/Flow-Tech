<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

        protected $fillable = [
        'name',
        'logo',
        'country_origin',
        'industry',
        'description',
        'product_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}