<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="https://sis.esu.ac.ae//assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://sis.esu.ac.ae//assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="apple-touch-icon" sizes="180x180" href="/theme/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/theme/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/theme/fav/favicon-16x16.png">
    <link rel="manifest" href="/theme/fav/site.webmanifest">

    <title>@yield('title') | {{__('main.ESU_online_services')}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <!--     <link href="https://sis.esu.ac.ae/theme/assets/css/bootstrap.min.css" rel="stylesheet" /> -->
    {{-- <link href="https://eit.sa/esu3/theme/assets/css/bootstrap.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="https://sis.esu.ac.ae//theme/assets/css/animate.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="https://sis.esu.ac.ae//theme/assets/css/paper-dashboard.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="https://sis.esu.ac.ae//theme/assets/css/themify-icons.css" rel="stylesheet">



    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css" type="text/css"
        media="screen">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" type="text/css"
        media="screen">

    <style>
        body {
            background-color: #24a8e1;
            background-image: url('/theme/images/fomrs_bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Montserrat", "Helvetica Neue", "Droid Arabic Kufi", sans-serif !important;
        }

        a {
            color: #24a8e1;
        }

        a:hover {
            color: #000000;
        }

        .card .card-footer .btn:hover {
            background: #000000 !important;
        }

        .main_block {
            background: #f3f3f3;
            padding: 0;
            box-shadow: 0 5px 5px;
        }

        .transcripts td b {
            text-transform: capitalize !important;
        }

        .transcripts .tab2 {
            margin-bottom: 10px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .logo_min {
            text-align: center;
            margin: 0;
            padding: 30px 0;
        }

        .content {
            padding-top: 100px;
        }

        .card-user .author {
            margin-top: 0;
        }

        .img-responsive {
            height: 200px;
            margin: auto;
        }

        .search-br .checkbox {
            position: absolute;
            left: 43%;
            top: 0;
        }

        [class^="ti-"],
        [class*=" ti-"] {
            font-weight: normal;
        }

        .card .icon-big {
            font-size: 5.4em;
        }

        .checkbox .icons,
        .radio .icons {
            color: #ddd;
        }

        .card {
            border-radius: 0;
        }

        .card {
            box-shadow: 0 0 0 !important;
            background-color: #FFFFFF;
            color: #252422;
            margin-bottom: 0px;
            position: relative;
        }

        .card .card-title {
            margin: 0;
            color: #24a8e1;
            font-weight: 300;
            margin-top: 0 !important;
            background: #ffffff;
            padding-bottom: 0px;
            padding-top: 10px;
            text-transform: none;
        }

        .card .card-header {
            padding: 0;
            position: relative;
            z-index: 3;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .card .card-content {
            padding: 15px 15px 10px 15px;
        }

        .card .card-title,
        .card .stats,
        .card .category,
        .card .description,
        .card .social-line,
        .card .actions,
        .card .card-content,
        .card .card-footer,
        .card small,
        .card a {
            position: relative;
        }

        .card .card-footer {
            padding: 0;
        }

        .card .card-footer .btn {
            border-radius: 0;
            margin-bottom: 15px;
            width: 100%;
        }

        .required {
            color: red;
        }

        .panel {
            padding: 0 20px 20px 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 20px;
        }

        .panel h4 {
            margin-top: 10px;
            font-weight: bold;
        }

        .card label {
            font-size: 17px;
        }

        .form-group input[type=file] {
            opacity: 1;
            position: unset;
        }

        .form-control {
            background-color: rgba(0, 0, 0, 0.1);
            border: 0px solid #e8e7e3;
            border-radius: 0;
            color: #000;
            font-size: 15px;
            padding: 7px 18px;
            height: 50px;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .form-control.input-no-border {
            border: 0 none;
        }

        .btn,
        .navbar .navbar-nav>a.btn {
            font-size: 15px;
            text-transform: capitalize;
            padding: 15px;
        }

        .card label {
            width: 100%;
            border-bottom: 0px solid #f3f3f3;
            padding-bottom: 0px;
        }

        .card label.not_border {
            border-bottom: 0px solid #f3f3f3;
            padding-bottom: 0;
        }

        .lang_href {
            width: auto;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            margin-top: 20px !important;
            text-align: center;
        }

        .lang_href a {
            background: #fff;
            padding: 5px 10px;
        }

        .form-group input[type=file] {
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto lang_href">
                @if(app()->isLocale('en'))
                    <a href="{{route('change-locale',['locale'=>'ar'])}}">العربية</a>
                @else
                    <a href="{{route('change-locale',['locale'=>'en'])}}">English</a>
                @endif
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="">
            <div class="content">
                <div class="container">
                    <div class="row">

                        <div class="col-md-8 m-auto main_block">

                            <div class="row m-0">

                                <div class="col-md-6 m-0 p-0 text-center">

                                    <p class="logo_min">
                                        <img src="/theme/images/logo.png" width="150" />
                                    </p>

                                    <p>
                                    <h5>{{__('main.welcome_to')}} {{__('main.ESU_online_services')}}</h5>
                                    </p>
                                    <p></p>
                                    @yield('contact')



                                </div>
                                <div class="col-md-6 m-0 p-0">

                                    @yield('content')

                                </div>

                            </div>
                           

                        </div>
                       
                    </div>
                    <div class=" col-md-12 mt-5 text-center" style="display: inline-block">
                        <a href="https://apps.apple.com/eg/app/id1631204544" target="_blank"><img src="{{url('theme/app_store_icon.png')}}" style="height:60px" class="image-responsive"></a>
                       
                        <a href="https://play.google.com/store/apps/details?id=com.sis.esu" target="_blank"><img src="{{url('theme/google_play_icon.png')}}" style="height:90px" class="image-responsive"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>