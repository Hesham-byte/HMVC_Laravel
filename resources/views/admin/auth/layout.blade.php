<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  {{-- <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template."> --}}
  {{-- <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard"> --}}
  <meta name="author" content="PIXINVENT">
  <link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">

  <title>@yield('title') | {{ config('app.name') }}</title>
  <link rel="apple-touch-icon" href="{{ url('/favicon.ico') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css/vendors.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/vendors/css/forms/icheck/icheck.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/vendors/css/forms/icheck/custom.css') }}">
  <!-- END VENDOR CSS-->
  <!-- BEGIN ROBUST CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css/app.css') }}">
  <!-- END ROBUST CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css/core/menu/menu-types/vertical-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css/pages/login-register.css') }}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/assets/css/style.css') }}">
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu" data-col="1-column"
style="background-image: url(/assets/admin/images/login-background.jpg); background-size: cover;"
>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="row">
                    <div class="col-md-12 m-auto lang_href text-center">
                        @if(app()->isLocale('en'))
                            <a class="bg-info text-white" href="{{route('change-locale',['locale'=>'ar'])}}">العربية</a>
                        @else
                            <a class="bg-info text-white" href="{{route('change-locale',['locale'=>'en'])}}">English</a>
                        @endif
                    </div>
                </div>
                @yield('content')
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="{{ url('assets/admin/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{ url('assets/admin/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/admin/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN ROBUST JS-->
  <script src="{{ url('assets/admin/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/admin/js/core/app.js') }}" type="text/javascript"></script>
  <!-- END ROBUST JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ url('assets/admin/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>