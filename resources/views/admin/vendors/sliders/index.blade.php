@extends('admin.layouts.app')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        العروض
                        <div style="float:left">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">إضافة</button>

                        </div>
                    </div>

                    <div class="card-body">

                        @if(session()->has('message'))
                            <div class="alert {{session('alert') ?? 'alert-info'}}">
                                {{ session('message') }}
                            </div>
                        @endif

                  
                                <table class="table  data-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">الصورة</th>
                                            <th scope="col">من</th>
                                            <th scope="col">الى</th>
                                            <th scope="col">العمليات</th>
                                        </tr>
                                    </thead> 
                                </table>
                           


                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="{{ route('the_vendor_sliders.store' , $vendor->user_name) }}" enctype="multipart/form-data">
                                        @csrf


                                    <div class="col-md-12" id="the_icon">
                                        <img src="{{ asset('admin/panel/img/upload.png') }}" style="width:60px;height:60px;margin: 16px 45%;background-color: black;" class="the_image_changing" onclick="document.getElementById('image').click()" alt="Cinque Terre">
                                        <h5 class="text-center">إرفع صورة من هنا</h5>
                                        <input  style="display: none;"  id="image" type="file" name="the_image">
                                        

                                        <div class="form-group row">
                                        
                                                <select  onchange="getSubCategories(this);" class="form-control">
                
                                                    <option selected sidabled>التصنيفات .....</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                
                                                </select>
                                        </div>
                
                
                                        <div class="form-group row">
                                        
                                                
                                                
                                                <select class="category_id form-control" name="category_id" id="category_id">
                                                
                                                    <option selected sidabled>فروع التصنيفات .....</option>

                                                </select>
                
                                               
                
                                                @error('category_id')
                                                    <span class="invalid-feedback" country="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                
                                        
                                        
                                        <input placeholder="من ....." class="form-control" type="text" onfocus="(this.type='date')" name="from">
                                        <input placeholder="إلى ......" class="form-control" type="text" onfocus="(this.type='date')" name="to">
                                        <br>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <button type="submit" class="btn btn-primary col-md-12">
                                            إضافة  
                                        </button>
                                    </div>

                                    </form>




                                </div>
                                
                            </div>
                        
                            </div>
                        </div>
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection    


@section('footer')

    <script>
        

        $(function () {
    
    var scroll_x=false;
    if($( window ).width()<=750) {
        scroll_x=true
    }
    var table = $('.data-table').DataTable({
         processing: true,
        serverSide: true,
        'scrollX': scroll_x,
        ajax: "{{ route('the_vendor_sliders.index' , Request::segment(3)) }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'from', name: 'from'},
            {data: 'to', name: 'to'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        dom: 'lBfrtip',
    });
    
  });


  $.fn.dataTable.ext.errMode = 'none';

    


    </script>

    <script>


        window.form_data = new FormData();

       
        function changeIcon(id){
            let file_data = $(`#image_${id}`).prop('files')[0];
            form_data.append('file_data', file_data);
            form_data.append('slider_id', $(`#slider_id_${id}`).val());
            

            axios.post('../../../../public/sliders', form_data)
            .then((data) => {
                location.reload();
                                      
            }).catch((error) => {

            
            
            });
        
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


        function getSubCategories(item){
            axios.get('../../../../public/list_subcategories/'+item.value)
                .then((data) => {
                $('#category_id').empty()
                for(subcategory of data.data){
                $('#category_id').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>')
                }  
            })
        }

        $('#category_id').on("change", function() {
            getOptions(this);
        });
    </script>
   
@endsection