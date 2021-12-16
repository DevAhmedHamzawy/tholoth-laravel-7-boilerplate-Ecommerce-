<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Settings;
use App\Cart;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {

       //dd($request->all());

 
    
       if($request->product_options == null) { return response()->json(['error' => 'Please Choose The Specific Option'], 422); } 

       

       Product::addToCart($request->product_id, $request->qty, $request->product_options);

       $cartContent = json_decode(Cart::where('identifier', auth()->user()->id)->get());

       //$cartContentOptions = json_decode(DB::table('shoppingcart')->where('identifier', auth()->user()->id)->first()->content['product_options']);
    
       return CartResource::collection($cartContent);
    }

    public function show()
    {
       $cart =  DB::table('shoppingcart')->where('identifier', auth()->user()->id)->get();

       //$cart == null ? : $cart->content = json_decode($cart->content);
       //dd($cart->content);


       $sub_total = [];
       $tax_rates = [];
       $discount_rates = [];

       foreach($cart as $item){
           $item = json_decode($item->content);


           array_push($sub_total, $item->product_price*$item->product_qty);
           array_push($tax_rates, round($item->product_price / 100) * Settings::findOrFail(1)->vat, 2);
           //array_push($discount_rates, $item->discountRate);
       }
      
     
       $sub_total = array_sum($sub_total);

       $tax_rates = array_sum($tax_rates);

       //$cart->discount_rates = array_sum($discount_rates);

       $total = $sub_total + $tax_rates; 

       //$cart->total_with_discount = $cart->total - $cart->discount_rates;

       return ['cart' => CartResource::collection($cart), 'sub_total' => $sub_total, 'tax_rates' => $tax_rates, 'total' => $total];
    }


    public function update(Request $request)
    {
        //dd('s');
        $updated = DB::table('shoppingcart')->where('id', $request->id)->update(['qty'=>$request->qty]);
        if($updated){

            $content = json_decode(DB::table('shoppingcart')->where('id', $request->id)->first()->content);

            $content->product_qty = $request->qty;

            DB::table('shoppingcart')->where('id', $request->id)->update(['content'=>json_encode($content)]);

            return  'Updated successfully'; 
        }else{
            return 'try again';
        }
        
    }

    public function delete(Request $request)
    {
          if( DB::table('shoppingcart')->where('id', $request->id)->delete()) {
                return 'deleted successfully';  
          }else{
            return 'try again';
        }
      
        
    }

    public function checkOut()
    {
        return auth()->user() ? response()->json(['authorized' => 'true']) : dd('s');
    }
    
    public function summary(Request $request)
    {
        $cartContent = DB::table('shoppingcart')->where('identifier', auth()->user()->id)->first()->content;
        $cartContent = unserialize($cartContent);
        
        //dd($cartContent);

        $product_ids = json_encode($cartContent->pluck('id'));
        $product_Qty = json_encode($cartContent->pluck('qty'));
        $product_options = $cartContent->pluck('options');

        //dd(count(json_decode($product_ids)));

        $vat = Settings::findOrFail(1)->vat;
        Product::addToCart($product_ids, $product_Qty, $product_options);

        Cart::setGlobalTax($vat);
    
        return ['shipping_address' => auth()->user()->shippingAddresses , 'cart' => cart::content()];
    }
}
