<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/frontEnd/images/') }}/faveicon.png">
    <link rel="icon" rel="apple-touch-icon" sizes="120x120"
        href="{{ asset('public/frontEnd/images/') }}/apple-icon-120x120.png" />
    <title>Great Deal || @yield('title', 'Dashboard')</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/custom/css/custom.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/custom/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/custom/css/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- DataTables -->
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/plugins/select2/select2.min.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">

    <!-- toastr css -->
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/css/toastr.min.css">
    <!-- sweet alert2 -->
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/css/sweetalert2.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/zoom.css">
    <!--news.css-->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/plugins/summernote/summernote-lite.css">
    <!--news.css-->
    <link rel="stylesheet" href="{{ asset('public/backEnd') }}/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @stack('css')
    <!-- jQuery -->
    <script src="{{ asset('public/backEnd') }}/plugins/jquery/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script type="text/javascript">
        function display_c() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct()', refresh)
        }

        function display_ct() {
            var x = new Date()
            document.getElementById('ct').innerHTML = x;
            display_c();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
    <script type="text/javascript">
        $("img").lazyload({
            effect: "fadeIn"
        });
    </script>
</head>
