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
        return $this->hasMany(Product::class);
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
