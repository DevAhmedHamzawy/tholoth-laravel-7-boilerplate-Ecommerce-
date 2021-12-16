<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Order;
use App\Returning;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReturningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $returnings = Order::all();

            return DataTables::of($returnings)->addIndexColumn()
            ->addcolumn('action', function($row){ $btn = '<a href="'.route("subcategories.index", [$row->slug]).'" class="btn btn-primary">عرض</a>'; return $btn; })
            ->addColumn('actionone', function($row){$btn = '<a href="'.route("categories.edit", [$row->slug]).'" class="edit btn btn-primary btn-sm">تعديل</a>';return $btn;})
            ->addColumn('actiontwo', function($row){$btn = '<a href="'.route("categories.delete", [$row->slug]).'" class="delete btn btn-danger btn-sm">حذف</a>';return $btn;})
            ->addColumn('actionthree', function($row){$btn = '<a href="'.route("the_sliders.index", [$row->slug]).'" class="edit btn btn-primary btn-sm">إظهار العروض</a>';return $btn;})
            ->rawColumns(['action','actionone','actiontwo', 'actionthree'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('vendor.returnings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Returning  $returning
     * @return \Illuminate\Http\Response
     */
    public function show(Returning $returning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Returning  $returning
     * @return \Illuminate\Http\Response
     */
    public function edit(Returning $returning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Returning  $returning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Returning $returning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Returning  $returning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Returning $returning)
    {
        //
    }
}
