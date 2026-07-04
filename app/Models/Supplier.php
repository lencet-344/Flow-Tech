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
        'gmail', 
        'telephone', 
        'identification_card', 
        'company', 
        'code_employee', 
        'no_inss', 
        'booking_idbooking'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}