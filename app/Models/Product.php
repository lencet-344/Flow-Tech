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
        if (empty($product->image)) {
            
            // 1. Extraemos la primera palabra usando mb_strtolower para no romper tildes
            $primeraPalabra = explode(' ', trim($product->name))[0];
            $nombreCorto = mb_strtolower($primeraPalabra, 'UTF-8');
            
            // 2. Banco de imágenes con tildes y sin tildes para evitar fallos
            $bancoImagenes = [
                'arroz'    => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YXJyb3p8ZW58MHx8MHx8fDA%3D',
                'azúcar'   => 'https://plus.unsplash.com/premium_photo-1726072362679-2b2023862024?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YXp1Y2FyfGVufDB8fDB8fHww',
                'azucar'   => 'https://plus.unsplash.com/premium_photo-1726072362679-2b2023862024?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YXp1Y2FyfGVufDB8fDB8fHww',
                'harina'   => 'https://plus.unsplash.com/premium_photo-1671377375657-5286f40ec0c7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aGFyaW5hfGVufDB8fDB8fHww',
                'avena'    => 'https://images.unsplash.com/photo-1614373532018-92a75430a0da?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8YXZlbmF8ZW58MHx8MHx8fDA%3D',
                'sal'      => 'https://plus.unsplash.com/premium_photo-1726072356923-bf1a9f8faeb0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'pasta'    => 'https://images.unsplash.com/photo-1598720290281-9f26ae6d6f81?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'cereal'   => 'https://images.unsplash.com/photo-1521483451569-e33803c0330c?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2VyZWFsfGVufDB8fDB8fHww',
                'galletas' => 'https://images.unsplash.com/photo-1741520735658-55eaae8a472c?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGdhbGxldGFzJTIwZW1wYWNhZGFzfGVufDB8fDB8fHww',
                
                
                'aceite'   => 'https://media.istockphoto.com/id/164299645/es/foto/aceite-para-cocinar.webp?a=1&b=1&s=612x612&w=0&k=20&c=ocE05c4maR3LwJVRWMDedpJq5UprKpw5BEI-ImeFpiQ=',
                'café'     => 'https://media.istockphoto.com/id/1072068026/es/foto/caf%C3%A9-en-grano-y-caf%C3%A9-molido-mont%C3%B3n-aislado-sobre-fondo-blanco.webp?a=1&b=1&s=612x612&w=0&k=20&c=ntjpFOxCpW0KBRmjMLlghn9p21TiIc1jt_Bp84jyBK4=',
                'cafe'     => 'https://media.istockphoto.com/id/1072068026/es/foto/caf%C3%A9-en-grano-y-caf%C3%A9-molido-mont%C3%B3n-aislado-sobre-fondo-blanco.webp?a=1&b=1&s=612x612&w=0&k=20&c=ntjpFOxCpW0KBRmjMLlghn9p21TiIc1jt_Bp84jyBK4=',
                'salsa'    => 'https://images.unsplash.com/photo-1624462048568-72794ee6d6f8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8c2Fsc2ElMjBkZSUyMHRvbWF0ZSUyMGtldGNodXR8ZW58MHx8MHx8fDA%3D',
                'leche'    => 'https://media.istockphoto.com/id/518843282/photo/pouring-milk.jpg?s=1024x1024&w=is&k=20&c=S0U4ykLiyMaSMdB81QDjYwEZKPYx9Ahn_NySC1Z5rbY=',
                
                
                'atún'     => 'https://media.istockphoto.com/id/163676308/es/foto/at%C3%BAn-trozos.webp?a=1&b=1&s=612x612&w=0&k=20&c=n_9JLFRoP0FRbdVKIJHx7ukHfVkaTe6FK061nO0Fc80=',
                'atun'     => 'https://media.istockphoto.com/id/163676308/es/foto/at%C3%BAn-trozos.webp?a=1&b=1&s=612x612&w=0&k=20&c=n_9JLFRoP0FRbdVKIJHx7ukHfVkaTe6FK061nO0Fc80=',
                'sardina'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHuZDF-CO58Op1oRcmcJE8bMh166GbJ_ZlT8nS7wWaKQ&s=10',
                'frijoles' => 'https://plus.unsplash.com/premium_photo-1671130295242-582789bd9861?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ];

            // Asignamos la imagen correspondiente o la genérica si no coincide
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