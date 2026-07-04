<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'cost',
        'presentation',
        'state',
        'code_bar',
        'category_id',
        'brand_id',
        'company_id',
        'offer_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite', 'product_id', 'user_id');
    }
}