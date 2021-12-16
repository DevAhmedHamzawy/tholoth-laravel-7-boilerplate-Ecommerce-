@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center"> تـــفـــاصـــيــــل الــــطـــــلــــب رقــــــم {{ $order->id }}</h4>
                </div>

                <div class="container">
                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-3">رقم العميل</h5>
                        <div class="col-md-3">{{ $order->user->id }}</div>
                        <h5 class="col-md-3">العميل</h5>
                        <div class="col-md-3">{{ $order->user->name }}</div>
                    </div>
                    <br>
                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-6">ضريبة القيمة المضافة</h5>
                        <div class="col-md-6">{{ $order->vat_rate }}</div>
                    </div>
                    
                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-6">حساب الضريبة الكلية للطلب</h5>
                        <div class="col-md-6">{{ $order->vat }}</div>
                    </div>

                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-6">السعر الصافى</h5>
                        <div class="col-md-6">{{ $order->sub_total }}</div>
                    </div>
                    
                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-6">السعر الكلى</h5>
                        <div class="col-md-6">{{ $order->total }}</div>
                    </div>

                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-6">حاله الطلب</h5>
                        <div class="col-md-6">{{ $order->status }}</div>
                    </div>
                    
                  
                    
                </div>


                <table class="table border-top-0">
                    <thead>
                      <tr>
                        <th>المنتجات</th>
                        <th>الكمية</th>
                        <th>الاختيارات</td>
                        <th>السعر</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($order->items as $item)
                      <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->options }}</td>
                        <td>{{ $item->price }}</td>
                      </tr>
                      @endforeach
                   
                      <tr>
                          <td>الإجمالي</td>
                          <td></td>
                          <td></td>
                          <td>{{ $order->items->sum('price') }}</td>
                      </tr>
                  
                    </tbody>
                  </table>
              

                  <div class="col-md-12">
                      <div class="btn btn-primary col-md-12">
                          <a href="{{ route('invoice', $order->id) }}" target="_blank" style="color: #fff;">
                            مــــــشـــــاهـــــدة الـــــفــــاتــــــورة
                          </a>
                      </div>
                  </div>
                
            </div>
        </div>
    </div>
</div>
@endsection