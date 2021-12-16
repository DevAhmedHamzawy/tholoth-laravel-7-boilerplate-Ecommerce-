<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    public function getTheOptionsAttribute()
    {
        return json_decode($this->options);
    }
}
