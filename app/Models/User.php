<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

        protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'cedula',
        'email',
        'password',
        'role',
        'two_factor_code',       
        'two_factor_expires_at',
        'is_premium',  
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorite', 'user_id', 'product_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'email', 'email');
    }


    /**
     * Comprueba si el usuario tiene un rol específico.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Comprueba si el usuario tiene alguno de los roles indicados.
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    // Helpers individuales para mayor comodidad
    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    public function isProveedor(): bool
    {
        return $this->role === 'proveedor';
    }

    public function isServicios(): bool
    {
        return $this->role === 'prestador_servicios'; // o la clave que uses para servicios
    }
}
