@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center"> {{ $user->name }}</h4>
                </div>

                <div class="container">
                    <div class="row justify-content-center text-center">
                        <h5 class="col-md-3">رقم</h5>
                        <div class="col-md-3">{{ $user->id }}</div>
                        <h5 class="col-md-3">البريد الإلكترونى</h5>
                        <div class="col-md-3">{{ $user->email }}</div>
                    </div>
                    <br>
                   
                    
                </div>


                <table class="table  data-table">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الرقم</th>
                            <th scope="col">العمليات</th>
                            <th scope="col">العمليات</th>
                        </tr>
                
                        
                        @foreach ($user->orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->id }}</td>
                            <td><a class="btn btn-primary" href="{{ route('orders.show', $order->id) }}" >تفاصيل الطلب</a></td>
                            <td><a class="btn btn-primary" target="_blank" href="{{ route('invoice', $order->id) }}" >عرض الفاتورة</a></td>
                        </tr>
                        @endforeach
                      
                    </thead>
                      
                </table>
                  
                
            </div>
        </div>
    </div>
</div>
@endsection