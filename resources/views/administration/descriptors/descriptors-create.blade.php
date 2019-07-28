@extends('layouts.administration', ['active' => 'descriptors'])
@section('title','Criar descritor - SAPO')
@section('content')
<div class="container">
  <br>
  <h3>Criar descritor</h3>
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
      <form method="POST" action="{{route('descritor.store')}}">
        @csrf
        <div class="form-group">
          <label for="idDescriptor">ID</label>
          <input type="text" id="idDescriptor" name="idDescriptor" class="form-control col-md-4 col-lg-4" placeholder="ID do descritor" required autofocus>
          <small id="idHelp" class="form-text text-muted">Utilize a nomenclatura padrão. (Ex.: "D1", "D2", "D3"...)</small>
          @if($errors->has('idDescriptor'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('idDescriptor')}}</strong>
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
        <div class="form-group row">
          <div class="col-lg-9">
            <input type="reset" class="btn btn-secondary" value="Cancelar">
            <input type="submit" class="btn btn-success" value="Salvar descritor">
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
