<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'name',
        'email',
        'address',
        'type_product',
        'production'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function contactRequests()
    {
        return $this->hasMany(ContactRequest::class);
    }
}
