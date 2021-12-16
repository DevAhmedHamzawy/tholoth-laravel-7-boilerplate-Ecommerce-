<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'credits'
    ];

    protected $with = ['shippingAddresses', 'orders', 'orders.items', 'orders.items.product', 'favourites', 'favourites.product'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class)->orderBy('id', 'desc');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favourites()
    {
        return $this->hasMany('App\Favourite');
    }
}
