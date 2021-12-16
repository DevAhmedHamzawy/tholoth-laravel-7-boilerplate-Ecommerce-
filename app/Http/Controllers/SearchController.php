<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Product::where('name', 'LIKE', '%'.$request->name.'%')->get();

        //$vendors = Admin::whereRole(1)->where('user_name', 'LIKE', '%'.$request->name.'%')->get();

        //$vendors->merge($products);

        return $vendors;
    }
}
