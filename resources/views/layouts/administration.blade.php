<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css"href="{{asset('css/template/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css"href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/datatables.min.css')}}"/>
    <link rel="stylesheet" type="text/css"href="{{asset('css/template/bootadmin.min.css')}}">
    <!-- JQuery e Datatables -->
    <script type="text/javascript" src="{{URL::to('js/template/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/template/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/template/datatables.min.js')}}"></script>

    <title>@yield('title')</title>
</head>
<body class="bg-light">
<!-- Menu horizontal -->
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="{{route('geral.index')}}">SAPO</a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="{{route('administracao.index')}}" class="dropdown-item">Perfil</a>
                        <a href="#" class="dropdown-item">Sobre</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Sair</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

<!-- Menu lateral -->
    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <li class="{{($dash_class == 'other') ? 'active' : ''}}">
                    <a href="#sm_base" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Base
                    </a>
                    <ul id="sm_base" class="list-unstyled collapse">
                        <li><a href="https://bootadmin.net/demo/base/colors">Colors</a></li>
                    </ul>
                </li>
                <hr>
                <li class="{{($dash_class == 'profile') ? 'active' : ''}}"><a href="{{route('administracao.index')}}"><i class="far fa-fw fa-address-card"></i> Perfil</a></li>
                <li class="{{($dash_class == 'about') ? 'active' : ''}}"><a href="#"><i class="fas fa-fw fa-info"></i> Sobre</a></li>
            </ul>
        </div>

<!-- Conteúdo -->
        <div class="content p-4">
          @yield('content')
        </div>
    </div>

    <script src="{{URL::to('js/template/moment.min.js')}}"></script>
    <script src="{{URL::to('js/template/bootadmin.min.js')}}"></script>

</body>
</html>
