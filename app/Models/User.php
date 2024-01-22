<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
        'status',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //cart
    public function carts()
    {
        return $this->hasOne(Cart::class);
    }

    
    //order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //review
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}

