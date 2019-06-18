<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{URL::to('css/template/bootstrap.min.css')}}">
    <script src="{{URL::to('js/template/fontawesome-all.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::to('css/template/datatables.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/template/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/template/bootadmin.min.css')}}">

    <title>Login | SAPO</title>
</head>

<body class="bg-light">
  <div id="app" class="container h-100">
    @yield('content')
  </div>

  <script src="{{URL::to('js/template/jquery.min.js')}}"></script>
  <script src="{{URL::to('js/template/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('js/template/datatables.min.js')}}"></script>
  <script src="{{URL::to('js/template/moment.min.js')}}"></script>
  <script src="{{URL::to('js/template/fullcalendar.min.js')}}"></script>
  <script src="{{URL::to('js/template/bootadmin.min.js')}}"></script>

</body>
</html>
