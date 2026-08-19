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
        
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function contact_requests()
    {
        return $this->hasMany(Contact_request::class);
    }
}
