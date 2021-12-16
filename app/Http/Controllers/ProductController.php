<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function mostSold()
    {
        return ProductResource::collection(Product::whereIn('id', DB::table('order_items')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->pluck('product_id'))->get());
    }

    public function productOffers()
    {
        return ProductResource::collection(Product::where('discount', '!=', 0)->get());
    }

}
