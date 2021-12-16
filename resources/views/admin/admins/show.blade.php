@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ $admin->user_name }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="col-md-12" id="the_icon">
                        <img src="{{ $admin->img_path }}"  class="the_image_changing" alt="Cinque Terre">
                        <input  style="display: none;"  id="image" type="file" name="main_image">
                    </div>
                    <br>

                   
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">الإسم</label>
                        <div class="col-md-10 mt-2">{{ $admin->user_name }}</div>
                    </div>

                  

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">البريد الإلكترونى</label>
                        <div class="col-md-10 mt-2">{{ $admin->email }}</div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-2"></div>
                    <a target="_blank" href="{{ route('the_vendor_products.index' , $admin->user_name) }}" class="btn btn-primary col-md-3">المنتجات</a>
                        <div class="col-md-3"></div>
                    <a target="_blank" href="{{ route('the_vendor_sliders.index' , $admin->user_name) }}" class="btn btn-primary col-md-3">العروض</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection