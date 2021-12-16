@extends('admin.layouts.app')

@section('head')
    <style>
        a { text-decoration: none; color: #f2f2f2; }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

           <div class="col-md-3">
               <div class="card">
                    <h1 class="text-center"><span class="material-icons" style="font-size:50px; padding:20px 0;">settings</span></h1>
                    <a href="{{ route('settings.edit') }}"><h5 class="text-center">الإعدادت الأساسية</h5></a>
               </div>
           </div>

           <div class="col-md-3">
                <div class="card">
                    <h1 class="text-center"><span class="material-icons" style="font-size:50px; padding:20px 0;">web_asset</span></h1>
                    <a href="{{ route('pages.edit', 'terms') }}"><h5 class="text-center">صفحة الشروط </h5></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <h1 class="text-center"><span class="material-icons" style="font-size:50px; padding:20px 0;">view_list</span></h1>
                    <a href="{{ route('pages.edit', 'faqs') }}"><h5 class="text-center">صفحة الإرشادات </h5></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <h1 class="text-center"><span class="material-icons" style="font-size:50px; padding:20px 0;">toc</span></h1>
                    <a href="{{ route('pages.edit', 'agreements') }}"><h5 class="text-center">صفحة التعهد</h5></a>
                </div>
            </div>

    </div>
</div>
@endsection