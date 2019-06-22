@extends('layouts.administration', ['active' => 'exams'])
@section('title','Criar avaliação - SAPO')
@section('content')
<div class="container">
  <br>
  <h2>Criar avaliação</h2>
  <br>

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @if(count($errors)>0)
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" action="{{route('avaliacao.store')}}">
        @csrf
        <div class="form-group">
          <label for="idExam">ID da avaliação</label>
          <input type="text" id="idExam" name="idExam" class="form-control col-md-4 col-lg-4" placeholder="ID da avaliação" required>
          @if($errors->has('idExam'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('idExam')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="subject">Disciplina</label>
          <select id="subject" name="subject" class="form-control col-md-3 col-lg-3" required>
            @foreach($subjects as $subject)
            <option value="{{$subject->name}}">{{$subject->description}}</option>
            @endforeach
          </select>
          @if($errors->has('subject'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('subject')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="description">Descrição</label>
          <textarea type="text" id="description" name="description" class="form-control" required></textarea>
          @if($errors->has('description'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('description')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="qNumber">Número de questões</label>
          <input type="number" id="qNumber" name="qNumber" class="form-control col-md-1 col-lg-1" placeholder="nº" min="1" max="30" required>
          @if($errors->has('qNumber'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('qNumber')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="scope">Escopo da avaliação</label>
          <select id="scope" name="scope" class="form-control col-md-6 col-lg-6" required>
            @foreach($schools as $school)
            <option value="{{$school->id}}">{{$school->name}}</option>
            @endforeach
          </select>
          <small id="scopeHelp" class="form-text text-muted">Determina quais perfis com acesso "Escola" poderão visualizar os resultados</small>
          @if($errors->has('scope'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('scope')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="source">Fonte de dados</label>
          <select id="source" name="source" class="form-control col-md-4 col-lg-4" required>
            @foreach($sources as $source)
            <option value="{{$source->name}}">{{$source->description}}</option>
            @endforeach
          </select>
          @if($errors->has('source'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('source')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="class">Série</label>
          <select id="class" name="class" class="form-control col-md-4 col-lg-4" required>
            @foreach($grades as $grade)
            <option value="{{$grade->name}}">{{$grade->description}}</option>
            @endforeach
          </select>
          @if($errors->has('class'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('class')}}</strong>
          </span>
          @endif
        </div>
        <br>
        <hr>
        <h3>Gabarito - questões</h3>
        <br>
        <div class="row">
          @for($i=1;$i<=30;$i++)
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">#{{$i}}</span>
            </div>
            <input type="text" id="q{{$i}}" name="q{{$i}}" class="form-control col-sm-1 col-md-1 col-lg-1">
          </div>
          @endfor
        </div>
        <hr>
        <div class="form-group row">
          <div class="col-lg-9">
            <input type="reset" class="btn btn-secondary" value="Cancelar">
            <input type="submit" class="btn btn-success" value="Salvar avaliação">
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
