<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

        protected $fillable = [
        'date_booking',
        'total_amount',
        'deposit_amount',
        'payment_method',
        'special_requests',
        'supplier_id',
    ];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
