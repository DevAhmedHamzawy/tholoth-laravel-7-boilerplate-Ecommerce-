@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header text-center">إضافة إختيار جديد</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('options.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">الإسم</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row the_options">
                            <label for="options" class="col-md-2 col-form-label text-md-right">الإختيارات</label>

                            <div class="col-md-10">
                                <input id="options" type="text" class="form-control @error('options') is-invalid @enderror" name="options[]" value="{{ old('options') }}" required autocomplete="options" autofocus>

                                @error('options')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="the_options_one">

                        </div>


                        <div class="col-md-12">
                            <button onclick="addOther();return false;"  style="margin-bottom: 50px;" class="btn btn-primary col-md-12">
                                إضافة إختيار اخر
                            </button>
                        </div>



                

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    إضافة
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')
    
    <script>

        function addOther(){
            var inputField = $('.the_options').clone();
            $('.the_options_one').html(inputField);
        }
        
    </script>

@endsection