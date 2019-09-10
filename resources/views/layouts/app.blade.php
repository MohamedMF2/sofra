<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Sofra </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
        {{--<!-- Bootstrap 3.3.7 -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">
    
        @if (app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
            <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">
    
            <style>
                body, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Cairo', sans-serif !important;
                }
            </style>
        @else
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
        @endif
    
        <style>
            .mr-2{
                margin-right: 5px;
            }
    
            .loader {
                border: 5px solid #f3f3f3;
                border-radius: 50%;
                border-top: 5px solid #367FA9;
                width: 60px;
                height: 60px;
                -webkit-animation: spin 1s linear infinite; /* Safari */
                animation: spin 1s linear infinite;
            }
    
            /* Safari */
            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                }
            }
    
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
    
        </style>
        {{--<!-- jQuery 3 -->--}}
        <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>
    
        {{--noty--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
        <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>
    
        {{--morris--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">
    
        {{--<!-- iCheck -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">
    
        {{--html in  ie--}}
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    </head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
  <a href="{{url(route('home'))}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{__('lang.sofra')}} </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{__('lang.sofra')}}  </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              @lang('lang.languages')   
            </a>
            <div class="dropdown-menu">
              <ul style="list-style-type: none; margin:2px" class="text-center ">
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li style=" padding-bottom:10px" > 
                <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                       {{ $properties['native'] }} 
               </a> 
             </li> 
            @endforeach
          </ul>
            </div>
          </li>

              <div class="pull-right">
                  
              <form action="{{ url('logout')}}" method="post">
                  @csrf
                  <button type="submit" class="btn  btn-lg btn-primary "> {{__('lang.logout')}}</button>
              </div>
            </form>
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dashboard_files/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> 
             {{auth()->user()->name}}
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i>  {{__('lang.online')}}</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li><a href="{{ url( route('city.index') ) }}"><i class="fa fa-list"></i> <span>{{__('lang.cities')}}</span></a></li>
        <li><a href="{{ url( route('category.index') ) }}"><i class="fa fa-list"></i> <span>{{__('lang.categories')}}</span></a></li>
        <li><a href="{{ url( route('payment.create') ) }}"><i class="fa fa-list"></i> <span>{{__('lang.payments')}}</span></a></li>
        <li><a href="{{ url( route('setting.edit') ) }}"><i class="fa fa-list"></i> <span>{{__('lang.settings')}}</span></a></li>
        <li><a href="{{ url( route('offer.index') ) }}"><i class="fa fa-list"></i> <span>{{__('lang.offers')}}</span></a></li>
        <li><a href="{{ url( route('contact.index') ) }}"><i class="fa fa-address-card"></i><span>{{__('lang.contacts')}}</span></a></li>
        <li><a href="{{ url( route('restaurant.index') ) }}"><i class="fa fa-book"></i>{{__('lang.restaurants')}}  </span></a></li>
        <li><a href="{{ url( route('client.index') ) }}"><i class="fa fa-users"></i> <span>{{__('lang.clients')}}  </span></a></li>
        <li><a href="{{ url( route('order.index') ) }}"><i class="fa fa-users"></i> <span>{{__('lang.orders')}}  </span></a></li>
        <li><a href="{{ url( route('admin.edit') ) }}"><i class="fa fa-book"></i> <span>{{__('lang.change password')}}</span></a></li>
        <li><a href="{{ url( route('user.index') ) }}"><i class="fa fa-users"></i> <span>{{__('lang.users')}}</span></a></li>
        <li><a href="{{ url( route('role.index') ) }}"><i class="fa fa-users"></i><i class="fa fa-key"></i>  <span>{{__('lang.roles')}}</span></a></li>
        <li><a href="{{ url( route('permission.index') ) }}"><i class="fa fa-key"></i> <span>{{__('lang.permissions')}}</span></a></li>

         <!-- <ul class="treeview-menu">-->
          <!--</ul>-->  
        {{-- 
        
        @role('admin')
        
        @endrole
         --}} --}}


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">      
        <h1>  
             @yield('page_title')  
        </h1>
        <small> 
            @yield('small_title')
        </small>   
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> @lang('lang.home')</a>
            </li>
            <li class="active">
                  @yield('page_title') 
            </li>
        </ol>
    </section>
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong> @lang('lang.version') 2.4.0 @lang('lang.Copyright') &copy; 2014-2016 <a href="https://adminlte.io"> @lang('lang.ebda3 Studio') </a> @lang('lang.All rights reserved') </strong> <br>
    
    
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
</div>

{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

{{--icheck--}}
<script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

{{--<!-- FastClick -->--}}
<script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

{{--<!-- AdminLTE App -->--}}
<script src="{{ asset('dashboard_files/js/adminlte.min.js') }}"></script>

{{--ckeditor standard--}}
<script src="{{ asset('dashboard_files/plugins/ckeditor/ckeditor.js') }}"></script>

{{--jquery number--}}
<script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>

{{--print this--}}
<script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>

{{--morris --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('dashboard_files/plugins/morris/morris.min.js') }}"></script>

{{--custom js--}}
<script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>
<script src="{{ asset('dashboard_files/js/custom/order.js') }}"></script>

@stack('scripts')
</body>
</html>

