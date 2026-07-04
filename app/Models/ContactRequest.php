<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactRequest extends Model
{
    use HasFactory;

    protected $table = 'contact_request';

    protected $fillable = [
        'company_id',
        'name',
        'telephone',
        'email',
        'location'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
