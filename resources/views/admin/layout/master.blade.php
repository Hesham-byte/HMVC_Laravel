<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  {{-- <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template."> --}}
  {{-- <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard"> --}}
  <meta name="author" content="PIXINVENT">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">

  <title>@yield('title') | {{ config('app.name') }}</title>
  <link rel="apple-touch-icon" href="{{ url('assets/admin/images/ico/apple-icon-120.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="assets/admin/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700"
  rel="stylesheet">

  @php
      $rtl = '';
      if(app()->isLocale('ar')){
        $rtl = '-rtl';
      }
  @endphp
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css'.$rtl.'/vendors.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/vendors/css'.$rtl.'/ui/prism.min.css')}}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css'.$rtl.'/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <!-- END VENDOR CSS-->
  <!-- BEGIN ROBUST CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css'.$rtl.'/app.css')}}">
  <!-- END ROBUST CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css'.$rtl.'/core/menu/menu-types/vertical-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/css'.$rtl.'/core/colors/palette-gradient.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/assets/css'.$rtl.'/style.css') }}">
  <!-- END Custom CSS-->


  {{-- datatable --}}
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

  {{-- fontawesom 5 --}}
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  {{-- fontawesome 6 --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  {{-- select 2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  {{-- taginput --}}
  <link rel="stylesheet" href="{{url('assets/admin/libs/taginput/bootstrap-tagsinput.css')}}">

  {{-- pretty checkboxes --}}
  <link rel="stylesheet" href="{{ url('assets/admin/libs/pretty-checkbox/pretty-checkbox.min.css')}}">

  {{-- bootstrap datepicker --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" />

  {{-- dropzone --}}
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />


  <style>
    button.dt-button, div.dt-button, a.dt-button, input.dt-button {
        color: #6bd098;
        border-color: #6bd098;
        background: transparent;
    }
    .imageThumb {
        width: 130px;
        height: 115px;
        cursor: pointer;
    }
    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }
    .remove {
        display: block;
        background: #fb3a3a;
        color: white;
        text-align: center;
        cursor: pointer;
    }
    .imagesPreview
    {
        padding: 50px 20px;
        border-radius: 3px;
        border: 2px dashed lightgrey;
    }

    .tab-menu ul { margin:0; padding:0; list-style:none; display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; }
    .tab-menu ul li
    {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
        text-align:center;
        margin: 0 2px;
    }
    .tab-menu ul li a
    {
        color: #5b5b5b;
        font-weight: bold;
        padding: 18px 0;
        display: block;
        text-decoration: none;
        transition: 0.5s all;
        border-radius: 5px;
        box-shadow: 0 0 10px #b7b7b7;
    }
    .tab-menu ul li a:hover { background: #d76eea; color:#fff; text-decoration:none; }
    .tab-menu ul li a.active { background:#9c27b0; color:#fff; text-decoration:none; }
    .tab-box { display:none; }

    .tab-main-box {  padding: 10px 30px; border-radius: 5px; border: 1px solid #eee; }

    .newItem
    {
        background: #f3f3f3;
        border-radius: 5px;
        padding: 20px;
    }

  </style>


  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/assets/css'.$rtl.'/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/assets/css/custom.css') }}">
  <!-- END Custom CSS-->


</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->
  @include('admin.layout.top-nav')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- side-menu-->
  @include('admin.layout.menu')

  <div class="app-content content">
    <div class="content-wrapper">
        @yield('content')
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; {{ date('Y') }} {{ config('app.name') }}, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
  </footer>
  <!-- JQuery JS-->
  {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>   --}}

  <!-- BEGIN VENDOR JS-->
  <script src="{{ url('assets/admin/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  {{-- <script src="{{ url('assets/admin/vendors/js/ui/unison.min.js') }}" type="text/javascript')"></script> --}}
  <!-- BEGIN VENDOR JS-->


  <!-- BEGIN ROBUST JS-->
  <script src="{{ url('assets/admin/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/admin/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/admin/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END ROBUST JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <!-- END PAGE LEVEL JS-->


  {{-- datatable scripts --}}
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

  {{-- select 2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- taginput --}}
  <script src="{{url('assets/admin/libs/taginput/bootstrap-tagsinput.js')}}"></script>

  {{-- tinyeditor --}}
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


   {{-- bootstrap datepicker --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

   {{-- sweet alert --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- dropzone --}}
  {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}


  <script>
      $(document).ready(function() {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          //datepicker
          $('.date-picker').datepicker({
              format:"yyyy-mm-dd"
          });
          $('.date-picker-year').datepicker({
              format:"yyyy"
          });

          // tinyint
          tinymce.init({
              selector: 'textarea.tiny', // Replace this CSS selector to match the placeholder element for TinyMCE
              directionality : @if(app()->isLocale('ar')) "rtl" @else "ltr" @endif,
              skin: 'bootstrap',
              plugins: 'lists, link, image, media, table, lineheight, code',
              lineheight_formats: "1pt 2pt 3pt 4pt 5pt 6pt 7pt 8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt",
              toolbar: 'lineheight ltr rtl h1 h2 bold italic strikethrough blockquote bullist numlist | alignleft alignjustify aligncenter alignright | backcolor hilitecolor | fontsizeselect | | link image media | table | removeformat code  ',
              menubar: true,
              language: "{{app()->getLocale()}}"
          });



          // select2 js
          $('.select-2').select2({
              placeholder: "@lang('main.choose')",
          });

          $('.select2-ajax').each(function(){
              let url = $(this).data('url');
              $(this).select2({
              ajax: {
                      url: url,
                      delay: 250,
                      processResults: function (data) {
                          return {
                              results: data
                          };
                      },
                      cache: true
                  }
              });
          });


          $('.data-table').DataTable({
              "order": [
                  [0,'desc']
              ]

              @if(app()->isLocale('ar'))
                      ,language: {
                             url: '{{ url("/theme/datatable-ar.json") }}'
                      }
              @endif
              @if(auth()->user()->role && auth()->user()->role->can_download)
              ,dom: 'Bfrtip'
              ,buttons: [
                  //'excel', 'pdf', 'print'
                  // { extend: 'pdf', className: 'dt-button buttons-excel buttons-html5' },
                  { extend: 'print', className: 'dt-button buttons-excel buttons-html5' },
                  { extend: 'excel', className: 'dt-button buttons-excel buttons-html5' }
              ]
              @endif
          });
      });
  </script>
  <style>
    .notShowControl .dataTables_filter, .notShowControl .dataTables_info,  .notShowControl .dataTables_paginate {display: none;}
  </style>

  @stack('js')

  @stack('modals')


  <script>
      $(document).ready(function() {
          if (window.File && window.FileList && window.FileReader) {
              $("#files").on("change", function(e) {
                  var files = e.target.files,
                      filesLength = files.length;
                  for (var i = 0; i < filesLength; i++) {
                      var f = files[i]
                      var fileReader = new FileReader();
                      fileReader.onload = (function(e) {
                          var file = e.target;
                          $("<span class=\"pip\">" +
                              "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                              "<br/><span class=\"remove\"><i class='fa fa-remove'></i></span>" +
                              "</span>").insertAfter("#files");
                          $(".remove").click(function(){
                              $(this).parent(".pip").remove();
                          });

                      });
                      fileReader.readAsDataURL(f);
                  }
                  console.log(files);
              });
          } else {

          }
      });
  </script>

    {{--  Custom Tabs   --}}
    <script>
        $('.tab-menu li a').on('click', function(){
            var target = $(this).attr('data-rel');
            $('.tab-menu li a').removeClass('active');
            $(this).addClass('active');
            $("#"+target).fadeIn('slow').siblings(".tab-box").hide();
            return false;
        });
    </script>

   {{--Add Rows and Delete Rows--}}
  <script>
      //Add New Row

      $(document).on('click','#addNewItem', function(){
          var row = $(this).parent().parent().find('#newItem').clone();
          $(row).find("input").val("");
          var length = $("#body").children().length;
          $(row).find(".sku").attr("name","options["+length+"][sku]");
          $(row).find(".color").attr("name","options["+length+"][color]");
          $(row).find(".size").attr("name","options["+length+"][size]");
          $(row).find(".volume").attr("name","options["+length+"][volume]");
          $(row).find(".option_name_en").attr("name","options["+length+"][option_name_en]");
          $(row).find(".option_name_ar").attr("name","options["+length+"][option_name_ar]");
          $(row).find(".option_value_ar").attr("name","options["+length+"][option_value_ar]");
          $(row).find(".option_value_en").attr("name","options["+length+"][option_value_en]");
          $(row).find(".price").attr("name","options["+length+"][price]");
          $(row).find(".discount_price").attr("name","options["+length+"][discount_price]");
          $(row).find(".stock").attr("name","options["+length+"][stock]");
          $(row).appendTo( $(this).parent().parent().find('#body'));
      });

      //Remove Row
      $(document).on('click','.removeItem', function(){
          if($("#body").children().length >1){
              $(this).parent().remove();
          }
      });
  </script>

</body>
</html>
