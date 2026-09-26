<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'latitude',
        'longitude',
        'address',
        'telephone',
        'type_product',
        'logo',
        'description',
        'website',
        'horario',
        'category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
{
    // Relación a través de la tabla inventories
    return $this->hasManyThrough(
        Product::class,
        Inventory::class,
        'supplier_id', // Llave foránea en la tabla inventories que apunta a Company
        'id',          // Llave foránea en la tabla products
        'id',          // Llave local en la tabla companies
        'product_id'   // Llave local en la tabla inventories que apunta a Product
    );
}
    

    public function contact_requests()
    {
        return $this->hasMany(Contact_request::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
