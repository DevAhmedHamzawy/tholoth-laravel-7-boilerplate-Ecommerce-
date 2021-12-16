@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">


<div class="row" style="margin-top: 60px; margin-right: 15px;">
  <div class="col-md-6">
  
      <div class="circle-tile">
        <a href="#">
            <div class="circle-tile-heading green">
                <i class="fa fa-shopping-cart fa-fw fa-3x"></i>
            </div>
        </a>
        <div class="circle-tile-content green">
            <div class="circle-tile-description text-faded">
                الطلبات
            </div>
            <div class="circle-tile-number text-faded">
               0
            </div>
            <a href="{{ route('v_orders.index') }}" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
        </div>
      </div>
      
      </div>
      
  
  
  
  <div class="col-md-6 ">
  
    <div class="circle-tile">
      <a href="#">
          <div class="circle-tile-heading dark-blue">
              <i class="fa fa-database fa-fw fa-3x"></i>
          </div>
      </a>
      <div class="circle-tile-content dark-blue">
          <div class="circle-tile-description text-faded">
              المنتجات
          </div>
          <div class="circle-tile-number text-faded">
            {{ $productCount }} 
          </div>
          <a href="{{ route('v_products.index') }}" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
      </div>
    </div>
    
    </div>
    
</div>  
  
    
    <div class="row" style="margin-right: 15px;">
  
      <div class="col-md-6 my-3">
  
        <div class="bg-mattBlackLight dashboard-card p-3" style="border-radius:8px;">
          <h3 class="mb-2 text-center">  الإعلانات حسب التصنيفات</h3>
          <div>{!! $countCategoryChart->container() !!}</div>
        </div>
  
  
      
      
      </div>
  
  
      <div class="col-md-6 my-3">
  
        <div class="bg-mattBlackLight dashboard-card p-3" style="border-radius:8px;">
          <h3 class="mb-2 text-center"> إحصائيات الطلبات لسنة  {{ date("Y") }}</h3>
          <div>{!! $OrdersInYearChart->container() !!}</div>
        </div>
  
        <div class="bg-mattBlackLight dashboard-card p-3" style="margin-top: 10px; border-radius:8px;">
          <h3 class="mb-2 text-center">  إحصائيات المنتجات لسنة {{ date("Y") }}</h3>
          <div>{!! $ProductsInYearChart->container() !!}</div>
        </div>
  
      </div>
  
    </div>



   
    
    <div class="row" style="margin-right: 15px;">
      <div class="col-md-6 my-3">
        <div class="bg-mattBlackLight dashboard-card p-3" style="border-radius:8px;">
    
          <h3 class="mb-2 text-center">   المنتجات الأكثر مبيعا  </h3>
    
          <table class="table table-striped" style="width: 95%;margin: 3%;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">الإسم</th>
                <th scope="col">عرض</th>
              </tr>
            </thead>
            @foreach ($users as $user)
              <tbody>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td><a href="{{ route("users.show", [$user->name]) }}" class="edit btn btn-primary btn-sm">عرض</a></td>
              </tbody>
            @endforeach
          </table>
    
        </div>
      </div>
      <div class="col-md-6 my-3">
        <div class="bg-mattBlackLight dashboard-card p-3" style="border-radius:8px;">
    
          <h3 class="mb-2 text-center">   المستخدمين الاكثر طلبا  </h3>
    
          <table class="table table-striped" style="width: 95%;margin: 3%;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">الإسم</th>
                <th scope="col">عرض</th>
              </tr>
            </thead>
            @foreach ($users as $user)
              <tbody>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td><a href="{{ route("users.show", [$user->name]) }}" class="edit btn btn-primary btn-sm">عرض</a></td>
              </tbody>
            @endforeach
          </table>
    
        </div>
      </div>
    </div>
    
      <div class="row" style="margin-right: 15px;">
        <div class="col-md-6 my-3">
          <div class="bg-mattBlackLight dashboard-card p-3" style="border-radius:8px;">
      
            <h3 class="mb-2 text-center">   المنتجات الجديدة  </h3>
    
            <table class="table table-striped" style="width: 95%;margin: 3%;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">الإسم</th>
                  <th scope="col">عرض</th>
                </tr>
              </thead>
              @foreach ($users as $user)
                <tbody>
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td><a href="{{ route("users.show", [$user->name]) }}" class="edit btn btn-primary btn-sm">عرض</a></td>
                </tbody>
              @endforeach
            </table>
      
          </div>
        </div>
        <div class="col-md-6 my-3">
          <div class="bg-mattBlackLight dashboard-card p-3" style="border-radius:8px;">
      
            <h3 class="mb-2 text-center">   الطلبات الجديدة  </h3>
    
            <table class="table table-striped" style="width: 95%;margin: 3%;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">الإسم</th>
                  <th scope="col">عرض</th>
                </tr>
              </thead>
              @foreach ($users as $user)
                <tbody>
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td><a href="{{ route("users.show", [$user->name]) }}" class="edit btn btn-primary btn-sm">عرض</a></td>
                </tbody>
              @endforeach
            </table>
      
          </div>
        </div>
     
      </div>
    
    </div>
    
    @endsection
    
    @section('footer')
    
    
    
    {!! $OrdersInYearChart->script() !!}
    {!! $countCategoryChart->script() !!}
    {!! $ProductsInYearChart->script() !!}
    {!! $postsByMonthChartTwo->script() !!}
    
    @endsection