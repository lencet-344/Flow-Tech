<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'product_id', 
        'supplier_id', 
        'quantity', 
        'batch_number', 
        'unit_cost', 
        'status', 
        'last_restocked'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}