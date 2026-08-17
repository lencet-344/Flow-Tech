<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact_request extends Model
{
    use HasFactory;

    protected $table = 'contact_request';

        protected $fillable = [
        'name',
        'email',
        'telephone',
        'location',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
