<?php

namespace App\Http\Controllers\Vendor;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $vendor)
    {
        if($vendor->id !== auth()->user()->id) { abort(403); }

        return view('vendor.settings.edit', ['vendor' => $vendor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $vendor)
    {
        if($vendor->id !== auth()->user()->id) { abort(403); }

        //$validator = Validator::make($request->all(), ['user_name' => 'required', 'email' => 'required']);

        //if($validator->fails()){
        //    return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        //

        if ($request->has('main_image')) {
            $request->merge(['img' => Upload::uploadImage($request->main_image, 'admins' , $vendor->id)]);
        }

        if ($request->has('password')) {
           // $request->merge(['password' => bcrypt($request->password)]);
        }

        //dd($request->password);
    
        $vendor->update($request->except('_token','_method','1','0', 'main_image'));
        return redirect()->route('v_dashboard');
    }

}
