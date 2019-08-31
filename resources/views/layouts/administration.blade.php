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
    <link rel="stylesheet" type="text/css"href="{{asset('css/custom.css')}}">
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
            <li class="nav-item">
              <a href="{{route('geral.index')}}" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="{{route('administracao.index')}}" class="nav-link">Administração</a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{Auth::user()->getFirstMediaUrl('picture', 'thumb')}}" class="rounded-circle">
                {{Auth::user()->name}}</a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                <a href="{{route('administracao.index')}}" class="dropdown-item">Perfil</a>
                <!--<a href="#" class="dropdown-item">Sobre</a>-->
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
          @if(Auth::user()->type == "Administrador")
          <li class="{{($active == 'exams') ? 'active' : ''}}">
            <a href="#sm_exams" data-toggle="collapse">
              <i class="far fa-fw fa-file-alt"></i> Avaliações
            </a>
            <ul id="sm_exams" class="list-unstyled collapse">
              <li>
                <a href="{{route('avaliacao.create')}}"><i class="fas fa-fw fa-plus text-success"></i> Criar avaliação</a></li>
              <li>
                <a href="{{route('avaliacao.index')}}"><i class="fas fa-fw fa-pencil-alt text-warning"></i> Editar avaliação</a></li>
            </ul>
          </li>
          <li class="{{($active == 'descriptors') ? 'active' : ''}}">
            <a href="#sm_descriptors" data-toggle="collapse">
              <i class="fas far-fw fa-tags"></i></i> Descritores
            </a>
            <ul id="sm_descriptors" class="list-unstyled collapse">
              <li>
                <a href="{{route('descritor.create')}}"><i class="fas fa-fw fa-plus text-success"></i> Criar descritor</a></li>
              <li>
                <a href="{{route('descritor.index')}}"><i class="fas fa-fw fa-pencil-alt text-warning"></i> Editar descritor</a></li>
            </ul>
          </li>
          <hr>
          <li class="{{($active == 'users') ? 'active' : ''}}">
            <a href="#sm_users" data-toggle="collapse">
              <i class="far fa-fw fa-user"></i> Usuários
            </a>
            <ul id="sm_users" class="list-unstyled collapse">
              <li>
                <a href="{{route('register')}}"><i class="fas fa-fw fa-plus text-success"></i> Cadastrar usuário</a>
              </li>
              <li>
                <a href="{{route('usuario.index')}}"><i class="fas fa-fw fa-pencil-alt text-warning"></i> Editar usuário</a>
              </li>
            </ul>
          </li>
          @endif
          <li class="{{($active == 'profile') ? 'active' : ''}}">
            <a href="{{route('administracao.index')}}"><i class="far fa-fw fa-address-card"></i> Perfil</a>
          </li>
          <!--<li class="{{($active == 'about') ? 'active' : ''}}">
            <a href="#"><i class="fas fa-fw fa-info"></i> Sobre</a>
          </li>-->
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
