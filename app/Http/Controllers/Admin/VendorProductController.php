<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use App\Option;
use App\Product;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request, Admin $vendor){
        if ($request->ajax()) {

            $products = Product::whereUserId($vendor->id)->get();

            return DataTables::of($products)->addIndexColumn()
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("the_vendor_products.edit", [Admin::whereId($row->user_id)->first()->user_name ,$row->slug]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actiontwo', function($row){$btn = '<a href="'.route("the_vendor_products.delete", [Admin::whereId($row->user_id)->first()->user_name ,$row->slug]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['actionone','actiontwo'])
            ->make(true);

        }

        return view('admin.vendors.products.index', compact('vendor'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Admin $vendor)
    {
        $options = Option::all();
        $categories = Category::whereCategoryId(null)->get();
        return view('admin.vendors.products.add', compact('options', 'categories', 'vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Admin $vendor)
    {
        $the_other_options = $request->the_other_options;

        foreach($the_other_options as $key => $value) {
            $options = json_decode(Option::findOrFail($key)->options);

            $newOptions = [];

            foreach($options as $key1 => $value1){
                
                array_push($newOptions, array_search((string)$key1, $value));
            }

            $the_other_options[$key] = $newOptions;
        }

       

        $request->merge(['user_id' => $vendor->id, 'slug' => Str::slug(request('name')), 'image' => Upload::uploadImage($request->main_image, 'products' , $request->code), 'options' => json_encode($the_other_options)]);
        Product::create($request->except('the_other_options', 'main_image'));

       

        return redirect()->route('the_vendor_products.index' , $vendor->user_name)->with('status', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $v_product
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $vendor)
    {
        //$this->index($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $v_product
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $vendor, Product $the_vendor_product)
    {
        $product = $the_vendor_product;

        $options = Option::all();
        $categories = Category::whereCategoryId(null)->get();

        // Get Current Category Then SubCategory
        $subCategory = Category::where('id', $product->category_id)->first();
        $subCategory == null ? $category = null : $category = Category::where('id', $subCategory->category_id)->first()->id;
        $theCategory = $category;
        $theSubCategory = $subCategory;


        $selectedOptions = (array)json_decode($product->options);

        //dd($v_product->category->options->toArray());

        //dd($selectedOptions);
       

        return view('admin.vendors.products.edit', compact('options', 'categories', 'product', 'theCategory', 'theSubCategory', 'selectedOptions', 'vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $v_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $vendor, Product $the_vendor_product)
    {
        $product = $the_vendor_product;

        if($request->has('main_image'))
        {
            $request->merge(['image' => Upload::uploadImage($request->main_image, 'products' , $request->code)]);
        }


        $the_other_options = $request->the_other_options;

        foreach($the_other_options as $key => $value) {
            $options = json_decode(Option::findOrFail($key)->options);

            $newOptions = [];

            foreach($options as $key1 => $value1){
                
                array_push($newOptions, array_search((string)$key1, $value));
            }

            $the_other_options[$key] = $newOptions;
        }


        $request->merge(['user_id' => $vendor->id, 'slug' => Str::slug(request('name')), 'options' => json_encode($the_other_options)]);
        $product->update($request->except('the_other_options', 'main_image'));

        return redirect()->route('the_vendor_products.index' , $vendor->user_name)->with('status', 'Product Updated Successfully');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $v_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $vendor, Product $the_vendor_product)
    {
        $the_vendor_product->delete();
        return redirect()->back()->with('status', 'Product Deleted Successfully');   
    }

    public function special(Product $v_product)
    {
        $v_product->special ^= 1 ;
        $v_product->update();

        return redirect()->back()->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);
    }
}

