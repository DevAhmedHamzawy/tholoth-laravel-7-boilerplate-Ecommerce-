<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    public function getImgPathAttribute()
    {
        return url('../storage/app/public/main/sliders/'. $this->image);
    }

    public function vendor()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
