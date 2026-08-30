<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

        protected $fillable = [
        'quantity',
        'batch_number',
        'unit_cost',
        'status',
        'last_restock',
        'update_restock',
        'product_id',
        'supplier_id',
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'supplier_id');
    }
}
