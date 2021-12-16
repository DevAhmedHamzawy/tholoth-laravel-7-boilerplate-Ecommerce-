<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css" integrity="sha384-Jt6Tol1A2P9JBesGeCxNrxkmRFSjWCBW1Af7CSQSKsfMVQCqnUVWhZzG0puJMCK6" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/panel/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [
          { title: 'My page 1', value: 'https://www.tiny.cloud' },
          { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
          { title: 'My page 1', value: 'https://www.tiny.cloud' },
          { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
          { title: 'None', value: '' },
          { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
          /* Provide file and text for the link dialog */
          if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
          }

          /* Provide image and alt text for the image dialog */
          if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
          }

          /* Provide alternative source and posted for the media dialog */
          if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
          }
        },
        templates: [
              { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
          { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
          { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin:  'oxide',
        content_css: 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });

    </script>

    
    <title>{{-- $settings->name --}} - لوحة التحكم</title>
    @yield('header')
</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top">

    <a class="navbar-brand" href="#"><img src="{{ asset('admin/panel/img/logo.png') }}" width="120" height="40" style="margin-right: 0.9em;" /></a>


    <button class="navbar-toggler sideMenuToggler" type="button" >
      <i class="fa fa-bars" style="color:#000; font-size:28px;"></i>
    </button> 
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" >

        <li class="">

            <a class=" "  style="margin-top:1px;" id="navbarDropdownMenuLink"  aria-haspopup="true" aria-expanded="false">
               <span class="hidden-xs">{{ Auth::user()->user_name }}</span>
              <img src="{{ url('/').'/'.Auth::user()->img }}" class="user-image" >
             
            </a>
            <!-- <div class="dropdown-menu" id="actions" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  تسجيل الخروج
              </a>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>             
            </div> -->
        </li>
        
         <li class="nav-item ">
              <a class="dropdown-item" href="{{ route('admin.logout') }}" style="margin-top:5px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <span class="fa fa-sign-out" style="color:#000;"></span>
                   
                  تسجيل الخروج

              </a>

         </li>
          <li class="nav-item dropdown messages-menu" style="display: none;">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" data-target="#notifications" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>
              <span class="label label-success bg-success">{{-- count($contact) --}}</span>
            </a>
            <div class="dropdown-menu" id="notifications" aria-labelledby="navbarDropdownMenuLink">
              <ul class="dropdown-menu-over list-unstyled">
                <li class="header-ul text-center">لديك {{-- count($contact) --}} رسائل جديدة</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu list-unstyled">
                  {{--  @foreach($contact as $c)
                    <li><!-- start message -->
                    <a href="#">
                      <div class="float-right">
                        <img src="http://via.placeholder.com/160x160" class="rounded-circle  " alt="User Image">
                      </div>
                      <h4>
                      {{ $c->name }}
                      <small><i class="fa fa-clock-o"></i>{{ $c->created_at }}</small>
                      </h4>
                      <p>{{ $c->text }}</p>
                    </a>
                  </li>
                  @endforeach --}}
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer-ul text-center"><a href="{{ url("../public/contacts") }}">مشاهدة كل الرسائل</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item dropdown notifications-menu" style='display: none'>
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" data-target="#messages" aria-haspopup="true" aria-expanded="false">
            <span class="material-icons">mail</span>
            <span class="label label-warning bg-warning">{{-- count($activity) --}}</span>
          </a>
          <div id="messages" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <ul class="dropdown-menu-over list-unstyled">
              <li class="header-ul text-center">لديك {{-- count($activity) --}} إشعارات جديدة</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu list-unstyled">
                  <li>
                   {{-- @foreach($activity as $a)
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> {{ $a->description }}
                    </a>
                    @endforeach --}}
                  </li>
                </ul>
              </li>
              <li class="footer-ul text-center"><a href="{{ url("../public/activitylog") }}">مشاهدة الكل</a></li>
            </ul>
          </div>
        </li>
        
        
      </ul>
    </div>
    <button class="navbar-toggler admin-collapse" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars" style="color:#000; font-size:28px;"></i>
    </button>



    <div class="user-menu-mobile nav-item text-left">

      <img src="{{ Auth::user()->image }}" class="user-image" >
      <span>{{ Auth::user()->user_name }}</span>
      |
      <a  href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out" style="color:#000;"></i>
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          @csrf
      </form>           

    </div>
      




    
    
</nav>

    <div class="wrapper d-flex">
        <div class="sideMenu bg-mattBlackLight" style="font-size: 18px;">
            <div class="sidebar">
                <ul class="navbar-nav">

                  <li class="nav-item"><a href="{{ url('admin/dashboard') }}" class="nav-link px-2"><i class="material-icons icon">dashboard</i><span class="text">لوحة التحكم </span></a></li>


                  @if (auth()->user()->role == 0)


                  <li class="nav-item"> 
                    <a href="#" data-toggle="collapse" data-target="#d" class="nav-link px-2 collapsed " > <i class="material-icons icon">web</i> <span class="text"> واجهة المتجر  </span> <span class="the_arrow fa fa-chevron-left text-light"></span> </a>
                    <ul class="sub-menu collapse" id="d"  >
                      <li class="nav-item"><a href="{{ url('admin/categories') }}" class="nav-link px-2"><span class="text text-white"> >> الأقسام</span></a></li>
                      <li class="nav-item"><a href="{{ url('admin/products') }}" class="nav-link px-2"><span class="text text-white"> >> المنتجات </span></a></li>  
                      {{--<li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">المدفوعات المكررة</span></a></li>  
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">الفلاتر</span></a></li>  
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">مواصفات المنتجات</span></a></li>--}}  
                      <li class="nav-item"><a href="{{ url('admin/options') }}" class="nav-link px-2"><span class="text text-white"> >>  خيارات المنتجات</span></a></li>
                      {{--<li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">الشركات</span></a></li>  
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">ملفات التنزيل</span></a></li>  
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">التقييم</span></a></li>  --}}
                      <li class="nav-item"><a href="{{ url('admin/pages') }}" class="nav-link px-2"><span class="text text-white"> >> معلومات </span></a></li>  
                    </ul>
                  </li>


                  <li class="nav-item"> 
                    <a href="#" data-toggle="collapse" data-target="#d_one" class="nav-link px-2 collapsed " > <i class="material-icons icon">point_of_sale</i> <span class="text"> المبيعات  </span> <span class="the_arrow fa fa-chevron-left text-light"></span> </a>
                    <ul class="sub-menu collapse" id="d_one"  >
                      <li class="nav-item"><a href="#" class="nav-link px-2"><span class="text text-white"> >> الطلبات </span></a></li>
                      <li class="nav-item"><a href="#" class="nav-link px-2"><span class="text text-white"> >> الإرجاع </span></a></li>
                      {{--<li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">المعلومات المكررة</span></a></li>
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">إرجاع المنتجات</span></a></li>
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">قسائم الهدايا</span></a></li>--}}
                    
                    </ul>
                  </li>


                  
                  <li class="nav-item"> 
                    <a href="#" data-toggle="collapse" data-target="#d_two" class="nav-link px-2 collapsed " > <i class="material-icons icon">person</i> <span class="text"> العملاء  </span> <span class="the_arrow fa fa-chevron-left text-light"></span> </a>
                    <ul class="sub-menu collapse" id="d_two"  >
                      <li class="nav-item"><a href="{{ url('admin/users') }}" class="nav-link px-2"><span class="text text-white"> >> العملاء </span></a></li>
                      {{--<li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">مجموعات العملاء</span></a></li>
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">الموافقة للعملاء</span></a></li>
                      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">خانات العملاء</span></a></li>--}}
                    </ul>
                  </li>



                    
                    
                    
                    
                    <li class="nav-item"> 
                      <a href="#" data-toggle="collapse" data-target="#d_three" class="nav-link px-2 collapsed " > <i class="material-icons icon">assignment_ind</i> <span class="text"> المستخدمين  </span> <span class="the_arrow fa fa-chevron-left text-light"></span> </a>
                      <ul class="sub-menu collapse" id="d_three"  >
                        <li class="nav-item"><a href="{{ url('admin/users') }}" class="nav-link px-2"><span class="text text-white"> >> العملاء </span></a></li>
                        <li class="nav-item"><a href="{{ url('admin/admins') }}" class="nav-link px-2"><span class="text text-white"> >> مديرين الموقع </span></a></li>
                        <li class="nav-item"><a href="{{ url('admin/the_vendors') }}" class="nav-link px-2"><span class="text text-white"> >> البائعين </span></a></li>
                      </ul>
                    </li>


                    <li class="nav-item"><a href="{{ url('admin/settings') }}" class="nav-link px-2"><i class="material-icons icon">settings</i><span class="text">إعدادات الموقع</span></a></li>



                    <li class="nav-item"><a href="#" class="nav-link sideMenuToggler px-2"><span class="text">ex</span><i class="material-icons icon">ex</i></a></li>
                   
                
                  @else

                  <li class="nav-item"><a href="{{ url('vendor/v_products') }}" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">المنتجات</span></a></li>
                  <li class="nav-item"><a href="{{ url('vendor/v_sliders') }}" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">العروض</span></a></li>
                 
                  <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">الطلبات</span></a></li>
                  <li class="nav-item"><a href="#" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">الإرتجاعات</span></a></li>

                 
                  <li class="nav-item"><a href="{{ url('vendor/v_settings/'.auth()->user()->user_name.'') }}" class="nav-link px-2"><i class="material-icons icon">collections</i><span class="text">إعدادات المتجر</span></a></li>

             
            

                  @endif
                 
                </ul>
            </div>
        </div>
    


    <div class="content">
        <main>
           
            @yield('content')
                        
        </main>
    </div>

   

</body>


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="{{ asset('admin/panel/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 <script>
   if($(".sideMenuToggler:first").css('display')!='none' ) {
        $('.wrapper').addClass('active');
    }
</script>


@yield('footer')
</html>