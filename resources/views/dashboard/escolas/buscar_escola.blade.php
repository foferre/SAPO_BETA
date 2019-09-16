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
  <span class="float-right"><a href="{{URL::to('/dashboard/escolas/resultado_geral')}}" class="btn btn-primary far fa-hand-point-left"> Voltar</a></span>
  <hr>
  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" action="{{route('avaliacao.store')}">
        @csrf
        <div class="form-group">
          <label for="school">Buscar resultado geral: </label>
          <select id="school" name="school" class="form-control col-md-6 col-lg-6" required>
            @foreach($schools as $school)
            <option value="{{$school->name}}">{{$school->name}}</option>
            @endforeach
          </select>
        </div>
        <button type="button" id="submit">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection
