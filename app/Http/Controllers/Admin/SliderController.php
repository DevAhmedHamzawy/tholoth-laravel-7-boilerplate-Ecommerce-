<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Slider;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request,  Category $category)
    {

        if ($request->ajax()) {

            $categories = Slider::whereCategoryId($category->id)->get();

            return DataTables::of($categories)->addIndexColumn()

            ->addColumn('image', function($row){
                //$url=asset("uploads/image/$product_brand->image"); 
                return '<img src='.$row->img_path.' border="0" width="100" class="img-rounded" align="center" />'; 
            })

            ->addColumn('added_by', function($row){
                //$url=asset("uploads/image/$product_brand->image"); 
                return $row->user_id == 0 ? 'إدارة الموقع' : $row->vendor->user_name ; 
            })

            ->addColumn('actionone', function($row){
                if($row->main_page == 0){
                    $btn = '<a href="'.route("the_sliders.main", [$row->id]).'" class="edit btn btn-primary btn-sm"> ظهور فالصفحة الرئيسية </a>';return $btn;
                }else{
                    $btn = '<a href="'.route("the_sliders.main", [$row->id]).'" class="edit btn btn-primary btn-sm"> عدم ظهور فالصفحة الرئيسية  </a>';return $btn;
                }
            })
            
            ->addColumn('actiontwo', function($row){$btn = '<a href="'.route("sliders.delete", [$row->id]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->rawColumns(['added_by','image','actionone','actiontwo'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.sliders.index', ['category' => $category]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), ['the_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000']);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }

        $request->merge(['image' => Upload::uploadImage($request->the_image, 'sliders' , rand(0,999999))]);
        Slider::create($request->except('_token','the_image'));
        return redirect()->back()->with(['message' => 'تم الإضافة بنجاح', 'alert' => 'alert-success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->back()->with(['message' => 'تم الحذف بنجاح', 'alert' => 'alert-success']);
    }

    public function main(Slider $slider)
    {
        $slider->main_page ^= 1 ;
        $slider->update();

        return redirect()->back()->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);
    }
}
