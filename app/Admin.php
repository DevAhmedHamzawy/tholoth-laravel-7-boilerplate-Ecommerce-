<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'user_name';
    }

    public function getImgPathAttribute()
    {
        return url('../storage/app/public/main/admins/'. $this->img);
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
} 