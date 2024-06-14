<?php

namespace App\Models;

use App\Notifications\EmailVerificationNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_MANAGER = 2;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;

    const ROLES = [
        self::ROLE_ADMIN => 'Администратор',
        self::ROLE_USER => 'Пользователь',
        self::ROLE_MANAGER => 'Менеджер'
    ];

    protected $fillable = [
        'full_name',
        'city',
        'city_ref',
        'lang',
        'phone',
        'email',
        'balance',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        if ($this->role === self::ROLE_ADMIN) {
            return true;
        }

        return false;
    }

    public function isManager()
    {
        if ($this->role === self::ROLE_MANAGER) {
            return true;
        }

        return false;
    }

    public function getRoleNameAttribute(): string
    {
        return self::ROLES[$this->attributes['role']] ?? '';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'user_favorite_products', 'user_id', 'product_id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }
}
