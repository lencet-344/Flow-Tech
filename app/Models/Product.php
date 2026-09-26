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
    protected static function booted()
    {
        static::creating(function ($product) {
            // Si el producto se está creando sin una imagen...
            if (empty($product->image)) {
                
                // Extraemos la primera palabra del nombre (ej: de "Arroz 117" a "arroz")
                $nombreCorto = strtolower(explode(' ', $product->name)[0]);
                
                // Tu "Base de datos" de imágenes
                $bancoImagenes = [
                    'frijoles' => 'https://images.unsplash.com/photo-1551462147-ff29053bfc14?w=400&q=80',
    'pasta'    => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=400&q=80',
    'aceite'   => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&q=80',
    'arroz'    => 'https://images.unsplash.com/photo-1586201375761-83865001e8ac?w=400&q=80',
    'café'     => 'https://images.unsplash.com/photo-1559525839-b184a4d698c7?w=400&q=80',
    'harina'   => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400&q=80',
    // Nuevos productos agregados
    'azúcar'   => 'https://images.unsplash.com/photo-1581456495146-65a71b2c8e52?w=400&q=80',
    'salsa'    => 'https://images.unsplash.com/photo-1472476443507-c7a5948772bf?w=400&q=80',
    'leche'    => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=400&q=80',
    'sal'      => 'https://images.unsplash.com/photo-1627448888022-7773db63b5f0?w=400&q=80',
                ];

                // Asignamos la imagen del banco, o una por defecto si no existe en la lista
                $product->image = $bancoImagenes[$nombreCorto] ?? 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=400&q=80';
            }
        });
    }

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