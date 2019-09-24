@extends('layouts.dashboard', ['active' => 'student'])
@section('title','Busca por aluno - SAPO')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <h1 class="text-center">Alunos - {{$exam->idExam}}</h1>
      <br>
      Disciplina: {{$exam->subject}}<br>
      Série/Ano: {{$exam->class}}º ano<br>
      {{$exam->description}}
      <span class="float-right">
        <a href="{{URL::to('/dashboard/alunos/avaliacoes')}}" class="btn btn-primary far fa-hand-point-left"> Voltar</a>
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
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card mb-4">
        <div class="card-body">
          <form method="POST" action="{{url('/dashboard/alunos/buscar_aluno')}}">
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
            <div class="input-group mb-3 form-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="student">Aluno:</span>
              </div>
              <input type="text" name="student" class="form-control col-md-8 col-lg-8" aria-label="Student" aria-describedby="student">
            </div>
            <input type="hidden" name="exam" value="{{$exam->id}}}">
            <button type="submit" class="btn btn-primary fas fa-search"></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @if(Session::has('success'))
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card mb-4">
        <div class="card-body">
          <table id="tabela" class="table table-hover table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th scope="col">Aluno</th>
                <th scope="col">Turma</th>
                <th scope="col">Avaliação</th>
                <th scope="col">Escola</th>
                <th class="actions">Visualizar</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($exams as $student)
              <tr>
                <td>{{$student->student}}</td>
                <td>{{$student->class}}</td>
                <td>{{$student->idExam}}</td>
                <td>{{$student->school}}</td>
                <td>
                  <a href="{{URL('/dashboard/alunos/'.$student->id.'/'.$exam->subject.'/'.$exam->class.'/'.$exam->id.'/buscar_aluno')}}" class="btn btn-primary fab fa-readme"></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <script src="{{URL::to('js/datatables/language.js')}}"></script>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
