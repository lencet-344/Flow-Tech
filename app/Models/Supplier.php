<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'age',
        'gender', 
        'address', 
        'email', 
        'telephone', 
        'identification_card', 
        'company', 
        'code_company', 
        'No_INSS'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}