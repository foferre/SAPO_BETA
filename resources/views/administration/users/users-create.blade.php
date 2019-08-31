@extends('layouts.administration', ['active' => 'users'])
@section('title','Criar usuário - SAPO')
@section('content')
<div class="container">
  <br>
  <h3>Criar usuário</h3>
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
      <form method="POST" action="{{route('usuario.store')}}">
        @csrf
        <div class="form-group">
          <label for="username">Nome de usuário</label>
          <input type="text" id="username" name="username" class="form-control col-md-3 col-lg-3" placeholder="Nome de usuário" required autofocus>
          @if($errors->has('username'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('username')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="password">Senha</label>
          <input id="password" type="password" class="form-control  col-md-4 col-lg-4{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" style="font-size:14px;" required>
          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('password') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="password-confirm">Confirmar senha</label>
          <input id="password-confirm" type="password" class="form-control col-md-4 col-lg-4" name="password_confirmation" style="font-size:14px;" required>
        </div>

        <hr>

        <div class="form-group">
          <label for="name">Nome de perfil</label>
          <input type="text" id="name" name="name" class="form-control col-md-6 col-lg-6" placeholder="Nome de perfil" required>
          @if($errors->has('name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('name')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="level">Nível de acesso</label>
          <select id="level" name="level" class="form-control col-md-2 col-lg-2" required>
            @foreach($types as $type)
            <option value="{{$type->description}}">{{$type->description}}</option>
            @endforeach
          </select>
          @if($errors->has('level'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('level')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="school">Escola</label>
          <select id="school" name="school" class="form-control col-md-6 col-lg-6" required>
            @foreach($schools as $school)
            <option value="{{$school->name}}">{{$school->name}}</option>
            @endforeach
          </select>
          @if($errors->has('school'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('school')}}</strong>
          </span>
          @endif
        </div>

        <hr>

        <div class="form-group row">
          <div class="col-lg-9">
            <input type="reset" class="btn btn-secondary" value="Cancelar">
            <input type="submit" class="btn btn-success" value="Criar usuário">
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
