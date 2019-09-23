@extends('layouts.dashboard', ['active' => 'class'])
@section('title','Resultado geral - SAPO')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-11 col-md-11 col-sm-11">
      <h3 class="text-center">Resultado geral - {{$exam->idExam}}</h3>
      <br>
      Disciplina: {{$exam->subject}}<br>
      Série/Ano: {{$exam->class}}º ano<br>
      {{$exam->description}}
      <span class="float-right">
        <a href="{{URL::to('/dashboard/turmas/resultado_geral')}}" class="btn btn-primary far fa-hand-point-left"> Voltar</a>
      </span>
    </div>
  </div>
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
      <form method="POST" action="{{url('/dashboard/turmas/buscar_escola')}}">
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
        <div class="input-group mb-3 form-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="class">{{$exam->class}}º</span>
          </div>
          <input type="text" name="class" class="form-control col-md-1 col-lg-1" aria-label="Class" aria-describedby="class" required>
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
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <p>Escola: {{$currentschool}}</p>
      <p>Turma: {{$exam->class}}º{{$currentclass}}</p>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-11 col-md-11 col-sm-11">
      <div class="chart-container">
        <canvas id="generalChart" class="generalChart"></canvas>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-11 col-md-11 col-sm-11">
      <h1 class="text-center">Gabarito</h1>
      <span class="float-right">
        <button class="btn btn-success far fa-hand-point-left" onclick="downloadCSV()"> Download</button>
      </span>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-11 col-md-11 col-sm-11">
      <div class="card mb-4">
        <div class="card-body">
          <table id="tabela" class="table table-hover table-striped" cellspacing="0">
            <thead>
              <tr>
                <th scope="col">Aluno</th>
                @foreach($descriptors as $descriptor)
                <th scope="col">{{$descriptor}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if($exam->source == "gf")
              @foreach($exams as $test)
              <tr>
                <td style="white-space:nowrap">{{$test->student}}</td>
                @for($i = 1; $i <= $exam->qNumber; $i++)
                @if(substr($test['q'.$i],1,1) == $exam['q'.$i])
                <td class="table-success">{{substr($test['q'.$i],1,1)}}</td>
                @else
                <td class="table-danger">{{substr($test['q'.$i],1,1)}}</td>
                @endif
                @endfor
              </tr>
              @endforeach
              @elseif($exam->source == "ap")
              @foreach($exams as $test)
              <tr>
                <td style="white-space:nowrap">{{$test->student}}</td>
                @for($i = 1; $i <= $exam->qNumber; $i++)
                @if($test['q'.$i] == $exam['q'.$i])
                <td class="table-success">{{$test['q'.$i]}}</td>
                @else
                <td class="table-danger">{{$test['q'.$i]}}</td>
                @endif
                @endfor
              </tr>
              @endforeach
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th scope="col">Aluno</th>
                @foreach($descriptors as $descriptor)
                <th scope="col">{{$descriptor}}</th>
                @endforeach
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="{{URL::to('js/datatables/language.js')}}"></script>
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
