@extends('layouts.dashboard', ['active' => 'class'])
@section('title','Descritores - SAPO')
@section('content')
<div class="container">
  <br>
  <h3 class="text-center">Descritores - {{$exam->idExam}}</h3>
  <br>
  Disciplina: {{$exam->subject}}<br>
  Série/Ano: {{$exam->class}}º ano<br>
  {{$exam->description}}
  <span class="float-right">
    <a href="{{URL::to('/dashboard/turmas/descritor_geral')}}" class="btn btn-primary far fa-hand-point-left"> Voltar</a>
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
      <form method="POST" action="{{url('/dashboard/turmas/descritores')}}">
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
      <p class="text-center title-chart-desc">Quantidade de avaliações realizadas</p>
      <p class="text-center number-chart-desc">{{$amount}}</p>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <p class="text-center title-chart-desc">Média geral</p>
      <p class="text-center number-chart-desc">{{$average}}%</p>
      <p class="text-center text-muted">de {{$exam->qNumber}} questões</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <p>Escola: {{$currentschool}}</p>
      <p>Turma: {{$exam->class}}º{{$currentclass}}</p>
    </div>
  </div>
  <div class="card">
      <div class="card-header bg-white font-weight-bold">
        {{$currentschool}} - Descritores
      </div>
      <div class="card-body">
      <div class="row">
        <div class="col-3">
          <div class="nav flex-column nav-pills descriptor-list" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @for($i=1;$i<=$exam->qNumber;$i++)
            <a class="nav-link {{($i==1) ? 'active' : ''}}" id="v-pills-{{$i}}-tab" data-toggle="pill" href="#v-pills-{{$i}}" role="tab" aria-controls="v-pills-{{$i}}" aria-selected="true">Questão {{$i}} - {{$exam['d'.$i]}}</a>
            @endfor
          </div>
        </div>
        <div class="col-9">
          <div class="tab-content" id="v-pills-tabContent">
            @for($i=1;$i<=$exam->qNumber;$i++)
            <div class="tab-pane fade show {{($i==1) ? 'active' : ''}}" id="v-pills-{{$i}}" role="tabpanel" aria-labelledby="v-pills-{{$i}}-tab">
              @if(round(($hit[$i]/$totalQuestion[$i])*100) >= 70)
              <p><b>Média de acertos: </b><span class="badge badge-success"> {{round(($hit[$i]/$totalQuestion[$i])*100)}}%</span></p>
              @elseif(round(($hit[$i]/$totalQuestion[$i])*100) >= 50)
              <p><b>Média de acertos: </b><span class="badge badge-warning"> {{round(($hit[$i]/$totalQuestion[$i])*100)}}%</span></p>
              @else
              <p><b>Média de acertos: </b><span class="badge badge-danger"> {{round(($hit[$i]/$totalQuestion[$i])*100)}}%</span></p>
              @endif
              <p><b>{{$exam['d'.$i]}}</b> - {{$description[$i]}}</p>
              <hr>
              <div class="bg-light p-3">
                <b>(A)</b> - {{$alternative[$i][1]}} {{($alternative[$i][1] == 1 ? 'aluno marcou esta alternativa' : 'alunos marcaram esta alternativa')}}
                <div class="progress"><div class="progress-bar {{($exam['q'.$i] == 'A' ? 'bg-success' : 'bg-danger')}}" role="progressbar" style="width: {{round(($alternative[$i][1] / $totalQuestion[$i])*100)}}%" aria-valuenow="{{$alternative[$i][1]}}" aria-valuemin="0" aria-valuemax="{{$totalQuestion[$i]}}">{{round(($alternative[$i][1] / $totalQuestion[$i])*100)}}%</div></div>
                <hr>
                <b>(B)</b> - {{$alternative[$i][2]}} {{($alternative[$i][2] == 1 ? 'aluno marcou esta alternativa' : 'alunos marcaram esta alternativa')}}
                <div class="progress"><div class="progress-bar {{($exam['q'.$i] == 'B' ? 'bg-success' : 'bg-danger')}}" role="progressbar" style="width: {{round(($alternative[$i][2] / $totalQuestion[$i])*100)}}%" aria-valuenow="{{$alternative[$i][2]}}" aria-valuemin="0" aria-valuemax="{{$totalQuestion[$i]}}">{{round(($alternative[$i][2] / $totalQuestion[$i])*100)}}%</div></div>
                <hr>
                <b>(C)</b> - {{$alternative[$i][3]}} {{($alternative[$i][3] == 1 ? 'aluno marcou esta alternativa' : 'alunos marcaram esta alternativa')}}
                <div class="progress"><div class="progress-bar {{($exam['q'.$i] == 'C' ? 'bg-success' : 'bg-danger')}}" role="progressbar" style="width: {{round(($alternative[$i][3] / $totalQuestion[$i])*100)}}%" aria-valuenow="{{$alternative[$i][3]}}" aria-valuemin="0" aria-valuemax="{{$totalQuestion[$i]}}">{{round(($alternative[$i][3] / $totalQuestion[$i])*100)}}%</div></div>
                <hr>
                <b>(D)</b> - {{$alternative[$i][4]}} {{($alternative[$i][4] == 1 ? 'aluno marcou esta alternativa' : 'alunos marcaram esta alternativa')}}
                <div class="progress"><div class="progress-bar {{($exam['q'.$i] == 'D' ? 'bg-success' : 'bg-danger')}}" role="progressbar" style="width: {{round(($alternative[$i][4] / $totalQuestion[$i])*100)}}%" aria-valuenow="{{$alternative[$i][4]}}" aria-valuemin="0" aria-valuemax="{{$totalQuestion[$i]}}">{{round(($alternative[$i][4] / $totalQuestion[$i])*100)}}%</div></div>
                <hr>
                Em branco - {{$alternative[$i][5]}} {{($alternative[$i][5] == 1 ? 'aluno marcou esta alternativa' : 'alunos marcaram esta alternativa')}}
                <div class="progress"><div class="progress-bar bg-secondary" role="progressbar" style="width: {{round(($alternative[$i][5] / $totalQuestion[$i])*100)}}%" aria-valuenow="{{$alternative[$i][5]}}" aria-valuemin="0" aria-valuemax="{{$totalQuestion[$i]}}">{{round(($alternative[$i][5] / $totalQuestion[$i])*100)}}%</div></div>
                <hr>
            </div>
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
