<?php

namespace App;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model implements Buyable 
{
    protected $guarded = [];

    protected $with = ['category', 'user'];

    protected $appends = ['img_path'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImgPathAttribute()
    {
        return url('../storage/app/public/main/products/'. $this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    public function favourites()
    {
        return $this->hasMany('App\Favourite');
    }

    public function getBuyableIdentifier($options = null) {
        return $this->id;
    }
    public function getBuyableDescription($options = null) {
        return $this->name;
    }
    public function getBuyablePrice($options = null) {
        return $this->price;
    }
    public function getBuyableWeight($options = null) {
        return $this->weight;
    }

    public static function addToCart($product_id, $qty, $options)
    {
        $product_ids = $product_id;
        $product_Qty = $qty;
        $product_options = $options;
        $discounts = [];

        //if(DB::table('shoppingcart')->where('identifier', auth()->user()->id)->exists()) {  DB::table('shoppingcart')->where('identifier', auth()->user()->id)->delete(); }

       // for ($i=0; $i < count($product_ids) ; $i++) { 

            $product = Product::findOrFail($product_ids);
            $product->discount != 0 ? $price = $product->discount * $product_Qty : $price = $product->price * $product_Qty;

            //array_push($discounts, $price - ($price * ($product->discount / 100)));            
            //array_sum($discounts) <= 0 ? : Cart::setDiscount(array_sum($discounts));

         
            //json_encode($product_options[$i])
            //var_dump($product_options[$i]);return;

            DB::table('shoppingcart')->insert(['instance' => auth()->user()->id, 'identifier' => auth()->user()->id, 'product_id' => $product_ids , 'product_options' => $product_options,  'qty' => $product_Qty ,
            'content' => json_encode(['product_id' => $product->id, 'product_name' => $product->name, 'product_image' => $product->img_path , 'product_qty' => $product_Qty, 'product_price' => $price, 'product_options' =>  $product_options ])]);

            
            //Cart::store(auth()->user()->id);
       // }
    }

      //Count Posts By Month
      public Static function FindProductsByMonth($categoryName, $monthNumber)
      {   
          $category = Category::whereName($categoryName)->first();
          //return Self::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $monthNumber)->whereCategoryId($category->id)->count();
          //return self::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $monthNumber)->get();
          return rand(0,50);
      }


    //Count Categories
    public static function CountCategories()
    {
         $categories = Category::whereCategoryId(null)->get();
         $countCategories = [];
         
         foreach($categories as $key => $value)
         {
            $key = $value->name;
            $countCategories[$key] = [];
            //$countCategories[$key] = count($value->posts);
            $countCategories[$key] = rand(0,100);
         }
  
         return $countCategories;
    }
}
