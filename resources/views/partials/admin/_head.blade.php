<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ADMIN @yield("title")</title>

    {{Html::style('/assets/bootstrap/dist/css/bootstrap.min.css')}}
    <!-- Font Awesome -->
    {{Html::style('/assets/font-awesome/css/font-awesome.min.css')}}
    <!-- NProgress -->
    {{Html::style('/assets/nprogress/nprogress.css')}}
    <!-- iCheck -->

      {{Html::style('/assets/iCheck/skins/flat/green.css')}}
    <!-- bootstrap-progressbar -->

    {{Html::style('/assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}
    <!-- JQVMap -->
    {{Html::style('/assets/jqvmap/dist/jqvmap.min.css')}}
    <!-- bootstrap-daterangepicker -->
    {{Html::style('/assets/bootstrap-daterangepicker/daterangepicker.css')}}

    <!-- Custom Theme Style -->
    {{Html::style('/assets/admin.custom.css')}}
    @yield("css")
</head>