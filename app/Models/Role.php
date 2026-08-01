<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

        protected $fillable = [
        'name',
        'type',
        'description',
        'user_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
