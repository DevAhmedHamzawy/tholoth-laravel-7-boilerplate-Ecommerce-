<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $vendors = Admin::whereRole(1)->get();

            return DataTables::of($vendors)->addIndexColumn()

            ->addColumn('action', function($row){$btn = '<a target="_blank" href="'.route("admins.show", [$row->user_name]).'" class="edit btn btn-primary btn-sm">عرض</a>';return $btn;})
            ->addColumn('actionone', function($row){$btn = '<a target="_blank" href="'.route("the_vendor_sliders.index", [$row->user_name]).'" class="edit btn btn-primary btn-sm">العروض</a>';return $btn;})
            ->addColumn('actiontwo', function($row){$btn = '<a target="_blank" href="'.route("the_vendor_products.index", [$row->user_name]).'" class="delete btn btn-danger btn-sm">المنتجات</a>';return $btn;})
            ->rawColumns(['action', 'actionone','actiontwo'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('admin.vendors.index');
    }

    
}
