@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header text-center">التعديل على المنتج {{ $product->name }}</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('the_vendor_products.update', [$vendor->user_name, $product->slug]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                        <div class="col-md-12" id="the_icon">
                            <img src="{{ $product->img_path }}" style="width:120px;height:120px;margin: 16px 44.5%;background-color: black;" class="the_image_changing"  onclick="document.getElementById('image').click()" alt="Cinque Terre">
                            <h5 class="text-center" style="margin-top: -15px;">إرفع صورة من هنا</h5>
                            <input  style="display: none;"  id="image" type="file" name="main_image">
                        </div>
                        <br>



                        <div class="form-group row">
                            <label for="subcategories" class="col-md-2 col-form-label text-md-right">التصنيفات</label>
                        
                            <div class="col-md-10">
                                <select  onchange="getSubCategories(this);" class="form-control">

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($theCategory == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="subcategories" class="col-md-2 col-form-label text-md-right">فروع التصنيفات</label>
                        
                            <div class="col-md-10">
                                

                                <select class="category_id form-control" name="category_id" id="category_id"></select>
                                

                                </select>

                               

                                @error('category_id')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-md-2 col-form-label text-md-right">الكود</label>

                            <div class="col-md-10">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $product->code }}" required autocomplete="code" autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">الإسم</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">السعر</label>

                            <div class="col-md-10">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="discount" class="col-md-2 col-form-label text-md-right">الخصم</label>

                            <div class="col-md-10">
                                <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $product->discount }}" required autocomplete="discount" autofocus>

                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">الوصف</label>

                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror textarea" cols="30" rows="10">{{ $product->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="the_selected_options" style="display: block;">
                            @foreach ($product->category->options as $key => $value)
                                {{-- dd($selectedOptions[$value->id]) --}}
                                <div class="form-check form-check-inline"><h3><input class="form-check-input" type="checkbox" name="options[]" id="inlineRadio1" value="'+option.id+'"><label class="form-check-label" for="inlineRadio1">{{ $value->name }}</label></h3></div><br>
                                @foreach($value->the_options as $key1 => $value1)

                                    @if($selectedOptions[$value->id][$key1] === false)
                                        <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="the_other_options[{{ $value->id }}][]"  id="inlineRadio1" value="{{ $key1 }}"><label class="form-check-label" for="inlineRadio1">{{  $value1  }}</label></div>
                                    @else
                                        <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" checked name="the_other_options[{{ $value->id }}][]"  id="inlineRadio1" value="{{ $key1 }}"><label class="form-check-label" for="inlineRadio1">{{  $value1  }}</label></div>
                                    @endif
                                 
                                
                                @endforeach
                                <br>
                            @endforeach
                        </div>

                        <div class="the_options_one">

                           

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
       $(document).ready(function () {
            let itemone = {};
            itemone.value = '{!! $theCategory !!}';
            getSubCategories(itemone);
        });


        function getSubCategories(itemone){
            axios.get('../../../../../list_subcategories/'+itemone.value)
                .then((data) => {
                $('#category_id').empty()
                for(subcategory of data.data){
                    if(subcategory.id == {!! $theSubCategory->id !!}){
                        $('#category_id').append('<option value="'+subcategory.id+'" selected>'+subcategory.name+'</option>')
                    }else{
                        $('#category_id').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>')
                    }
                }  
            })
        }


        $('#category_id').on("change", function() {
            getOptions(this);
        });


        function getOptions(item){
            axios.get('../../../../../list_options/'+item.value)
                .then((data) => { 
                    $('.the_options_one').empty();
                    $('.the_options_one').append('<label for="description" class="col-md-12 col-form-label text-md-right"><h2 class="text-center">الإختيارات</h2></label>');

                    for(option of data.data){
                        //$('.the_options_one').append('<div class="row">');
                        $('.the_options_one').append('<div class="form-check form-check-inline"><h3><input class="form-check-input" type="checkbox" name="options[]" id="inlineRadio1" value="'+option.id+'"><label class="form-check-label" for="inlineRadio1">'+option.name+'</label></h3></div><br>');
                        //$('.the_options_one').append('</div>');


                            console.log(option.options);

                        for(the_option of option.options){
                            //console.log(the_option);
                            //$('.the_options_one').append('<div class="row">');
                            $('.the_options_one').append('<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="the_other_options['+option.id+'][]" id="inlineRadio1" value="'+option.options.indexOf(the_option)+'"><label class="form-check-label" for="inlineRadio1">'+the_option+'</label></div>');
                            //$('.the_options_one').append('</div>');
                        }

                        $('.the_options_one').append('<br>');
                    }
                 })
        }


        function changeImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('.the_image_changing').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            changeImage(this);
        });
    </script>
@endsection