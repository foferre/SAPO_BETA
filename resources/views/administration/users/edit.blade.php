@extends('layouts.administration', ['active' => 'exams'])
@section('title','Editar avaliação - SAPO')
@section('content')
<div class="content-wrapper">
  <br>
  <h3>Editar avaliação - {{$exam->idExam}}</h3>
  <br>
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{Session::get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @elseif(Session::has('error'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    {{Session::get('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" action="{{route('avaliacao.update', $exam->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="idExam">ID da avaliação</label>
          <input type="text" id="idExam" name="idExam" class="form-control col-md-4 col-lg-4" placeholder="ID da avaliação" value="{{$exam->idExam}}" required autofocus>
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
            @if($exam->subject == $subject->name)
            <option value="{{$subject->name}}" selected>{{$subject->description}}</option>
            @else
            <option value="{{$subject->name}}">{{$subject->description}}</option>
            @endif
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
          <textarea type="text" id="description" name="description" class="form-control" required>{{$exam->description}}</textarea>
          @if($errors->has('description'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('description')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="qNumber">Número de questões</label>
          <input type="number" id="qNumber" name="qNumber" class="form-control col-md-1 col-lg-1" placeholder="nº" min="1" max="30" value="{{$exam->qNumber}}" required>
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
            @if($exam->scope == $school->id)
            <option value="{{$school->id}}" selected>{{$school->name}}</option>
            @else
            <option value="{{$school->id}}">{{$school->name}}</option>
            @endif
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
            @if($exam->source == $source->name)
            <option value="{{$source->name}}" selected>{{$source->description}}</option>
            @else
            <option value="{{$source->name}}">{{$source->description}}</option>
            @endif
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
            @if($exam->class == $grade->name)
            <option value="{{$grade->name}}" selected>{{$grade->description}}</option>
            @else
            <option value="{{$grade->name}}">{{$grade->description}}</option>
            @endif
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
        <h3 class="text-center">Gabarito</h3>
        <hr>
        <h3>Questões</h3>
        <br>
        <div class="form-group row">
          @for($i=1;$i<=30;$i++)
          <div class="col-lg-2 col-md-2 col-sm-4">
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">#{{$i}}</span>
              </div>
              <input type="text" id="q{{$i}}" name="q{{$i}}" class="form-control col-sm-12 col-md-12 col-lg-12" value="{{$exam['q'.$i]}}" >
            </div>
          </div>
          @endfor
        </div>
        <hr>
        <h3>Descritores</h3>
        <br>
        <div class="form-group row">
          @for($i=1;$i<=30;$i++)
          <div class="col-lg-2 col-md-2 col-sm-4">
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">#{{$i}}</span>
              </div>
              <input type="text" id="d{{$i}}" name="d{{$i}}" class="form-control col-sm-12 col-md-12 col-lg-12" value="{{$exam['d'.$i]}}">
            </div>
          </div>
          @endfor
        </div>
        <hr>
        <div class="form-group row">
          <div class="col-lg-9">
            <input type="reset" class="btn btn-secondary" value="Cancelar">
            <input type="submit" class="btn btn-success" value="Salvar alterações">
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
