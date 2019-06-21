<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/template/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/template/bootadmin.min.css')}}">

    <title>@yield('title')</title>
</head>

<body class="bg-light">
  <div id="app" class="container h-100">
    @yield('content')
  </div>

  <script src="{{URL::to('js/template/jquery.min.js')}}"></script>
  <script src="{{URL::to('js/template/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('js/template/bootadmin.min.js')}}"></script>

</body>
</html>
