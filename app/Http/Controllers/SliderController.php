<?php

namespace App\Http\Controllers;

use App\Http\Resources\SliderResource;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function main()
    {
        return SliderResource::collection(Slider::whereMainPage(1)->get());
    }

    public function byCategory($id)
    {
        return SliderResource::collection(Slider::whereCategoryId($id)->get());
    }
}
