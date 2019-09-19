@extends('layouts.dashboard', ['active' => 'schools'])
@section('title','Resultado geral - SAPO')
@section('content')
<div class="container">
  <br>
  <h3 class="text-center">Resultado geral - {{$exam->idExam}}</h3>
  <br>
  Disciplina: {{$exam->subject}}<br>
  Série/Ano: {{$exam->class}}º ano<br>
  {{$exam->description}}
  <span class="float-right">
    <a href="{{URL::to('/dashboard/escolas/resultado_geral')}}" class="btn btn-primary far fa-hand-point-left"> Voltar</a>
  </span>
  <hr>
  @if(Session::has('error'))
    <div class="alert alert-warning">
      Nenhum resultado encontrado!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif
  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" action="{{url('/dashboard/escolas/buscar_escola')}}">
        @csrf
        <div class="form-group">
          <label for="school">Buscar resultado geral: </label>
          <select id="school" name="school" class="form-control col-md-6 col-lg-6" required>
            @foreach($schools as $school)
            @if($school->name == 'Geral')
            @continue
            @else
            <option value="{{$school->name}}">{{$school->name}}</option>
            @endif
            @endforeach
          </select>
        </div>
        <input type="hidden" name="exam" value="{{$exam->id}}}">
        <button type="submit" class="btn btn-primary fas fa-search"></button>
      </form>
    </div>
  </div>
  <hr>
  @if(Session::has('success'))
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <p class="text-center title-chart">Quantidade de avaliações realizadas</p>
      <p class="text-center number-chart">{{$amount}}</p>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <p class="text-center title-chart">Média geral</p>
      <p class="text-center number-chart">{{$average}}%</p>
      <p class="text-center text-muted">de {{$exam->qNumber}} questões</p>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="chart-container">
        <canvas id="generalChart" class="generalChart"></canvas>
      </div>
    </div>
  </div>
  <script>
    var amount = {{$amount}};
    var qNumber = {{$exam->qNumber}};
    var hit = Object.values({!! json_encode($hit, JSON_HEX_TAG) !!});
    var miss = Object.values({!! json_encode($miss, JSON_HEX_TAG) !!});
    var descriptors = Object.values({!! json_encode($descriptors, JSON_HEX_TAG) !!});
  </script>
  <script type="text/javascript" src="{{URL::to('js/charts/generalChart.js')}}"></script>
  @endif
</div>
@endsection
