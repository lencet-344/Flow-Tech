<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offer';

    protected $fillable = [
        'tittle',
        'type_offer',
        'discount',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
