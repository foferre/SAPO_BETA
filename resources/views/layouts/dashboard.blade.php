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
    <link rel="stylesheet" type="text/css"href="{{asset('css/chart.min.css')}}">
    <!-- JQuery e Datatables -->
    <script type="text/javascript" src="{{URL::to('js/template/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/template/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/template/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/chart.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/chartjs-plugin-datalabels.min.js')}}"></script>

    <title>@yield('title')</title>
</head>
<body class="bg-light">
  <!-- Menu horizontal -->
      <nav class="navbar navbar-expand navbar-dark bg-grey">
          <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
          <a class="navbar-brand" href="{{URL::to('dashboard/geral/resultado_geral')}}">SAPO</a>

          <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="{{URL::to('dashboard/geral/resultado_geral')}}" class="nav-link">Dashboard</a>
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
                <li class="cd-label">Dashboard</li>
                <li class="{{($active == 'general') ? 'active' : ''}}">
                  <a href="#sm_general" data-toggle="collapse">
                    <i class="fa fa-fw fa-tachometer-alt"></i> Visão geral
                  </a>
                  <ul id="sm_general" class="list-unstyled collapse">
                    <li>
                      <a href="{{URL::to('dashboard/geral/resultado_geral')}}"><i class="fas fa-chart-line"></i> Resultado geral</a></li>
                    <li>
                      <a href="{{URL::to('dashboard/geral/descritor_geral')}}"><i class="fas fa-chart-bar"></i> Descritores</a></li>
                  </ul>
                </li>
                <li class="{{($active == 'schools') ? 'active' : ''}}">
                  <a href="#sm_schools" data-toggle="collapse">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i> Escolas
                  </a>
                  <ul id="sm_schools" class="list-unstyled collapse">
                    <li>
                      <a href="{{URL::to('dashboard/escolas/resultado_geral')}}"><i class="fas fa-chart-line"></i> Resultado geral</a></li>
                    <li>
                      <a href="{{URL::to('dashboard/escolas/descritor_geral')}}"><i class="fas fa-chart-bar"></i> Descritores</a></li>
                  </ul>
                </li>
                <li class="{{($active == 'class') ? 'active' : ''}}">
                  <a href="#sm_class" data-toggle="collapse">
                    <i class="fas fa-fw fa-users"></i> Turmas
                  </a>
                  <ul id="sm_class" class="list-unstyled collapse">
                    <li>
                      <a href="{{URL::to('dashboard/turmas/resultado_geral')}}"><i class="fas fa-chart-line"></i> Resultado geral</a></li>
                    <li>
                      <a href="{{URL::to('dashboard/turmas/descritor_geral')}}"><i class="fas fa-chart-bar"></i> Descritores</a></li>
                  </ul>
                </li>
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
