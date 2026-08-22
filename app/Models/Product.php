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
        'code_bar'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}