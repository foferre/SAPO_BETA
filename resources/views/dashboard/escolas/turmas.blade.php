@extends('layouts.dashboard', ['active' => 'general'])
@section('title','Resultado geral - SAPO')
@section('content')
<div class="container">
  <br>
  <h3 class="text-center">Resultado geral - {{$exam->idExam}}</h3>
  <br>
  Disciplina: {{$exam->subject}}<br>
  Série/Ano: {{$exam->class}}º ano<br>
  {{$exam->description}}
  <hr>
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
</div>
@endsection
