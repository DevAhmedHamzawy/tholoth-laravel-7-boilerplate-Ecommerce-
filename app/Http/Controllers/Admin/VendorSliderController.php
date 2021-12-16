<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Category;
use App\Slider;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class VendorSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request, Admin $vendor)
    {

        $categories = Category::whereCategoryId(null)->get();

        if ($request->ajax()) {

            $sliders = Slider::whereUserId($vendor->id)->get();

            return DataTables::of($sliders)->addIndexColumn()

            ->addColumn('image', function($row){
                //$url=asset("uploads/image/$product_brand->image"); 
                return '<img src='.$row->img_path.' border="0" width="100" class="img-rounded" align="center" />'; 
            })

        
            
            ->addColumn('action', function($row){$btn = '<a href="'.route("the_vendor_sliders.delete", [Admin::whereId($row->user_id)->first()->user_name ,$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['image','action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.vendors.sliders.index', compact('categories','vendor'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Admin $vendor)
    {
        
        $validator = Validator::make($request->all(), ['the_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000']);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }

        $request->merge(['user_id' => $vendor->id, 'image' => Upload::uploadImage($request->the_image, 'sliders' , rand(0,999999))]);
        Slider::create($request->except('_token','the_image'));
        return redirect()->back()->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $vendor, Slider $the_vendor_slider)
    {
        $the_vendor_slider->delete();
        return redirect()->back()->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }

    public function main(Slider $slider)
    {
        $slider->main_page ^= 1 ;
        $slider->update();

        return redirect()->back()->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);
    }
}