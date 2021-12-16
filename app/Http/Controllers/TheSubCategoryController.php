<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class TheSubCategoryController extends Controller
{
    public function index($id)
    {
        return CategoryResource::collection(Category::where('category_id',$id)->get());
    }
}
