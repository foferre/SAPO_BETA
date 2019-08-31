@extends('layouts.administration', ['active' => 'users'])
@section('title','Editar usuário - SAPO')
@section('content')
<div class="content-wrapper">
  <br>
  <h3>Editar usuário - {{$user->username}}</h3>
  <br>
  @if(Session::has('alert'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ Session::get('alert') }}
    @php
    Session::forget('alert');
    @endphp
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif

  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" action="{{route('usuario.update', $user->id)}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="username">Nome de usuário</label>
          <input type="text" id="username" name="username" class="form-control col-md-4 col-lg-4 {{$errors->has('username') ? ' is-invalid' : ''}}" value="{{$user->username}}" required autofocus>
          @if($errors->has('username'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('username')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="password">Nova senha</label>
          <input type="password" id="password" name="password" class="form-control  col-md-4 col-lg-4 {{$errors->has('password') ? ' is-invalid' : '' }}" placeholder="Digite uma nova senha">
          <small id="passHelp" class="form-text text-muted">A senha deve conter no mínimo 4 caracteres</small>
          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{$errors->first('password') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="password-confirmation">Confirmar senha</label>
          <input id="password-confirmation" name="password_confirmation" type="password" class="form-control col-md-4 col-lg-4" placeholder="Confirme a nova senha">
        </div>

        <hr>

        <div class="form-group">
          <label for="name">Nome de perfil</label>
          <input type="text" id="name" name="name" class="form-control col-md-6 col-lg-6 {{$errors->has('name') ? ' is-invalid' : '' }}" value="{{$user->name}}" required>
          @if($errors->has('name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('name')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="type">Nível de acesso</label>
          <select id="type" name="type" class="form-control col-md-2 col-lg-2 {{$errors->has('type') ? ' is-invalid' : '' }}" required>
            @foreach($types as $type)
            @if($user->type == $type->description)
            <option value="{{$type->description}}" selected>{{$type->description}}</option>
            @else
            <option value="{{$type->description}}">{{$type->description}}</option>
            @endif
            @endforeach
          </select>
          @if($errors->has('type'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('type')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="school">Escola</label>
          <select id="school" name="school" class="form-control col-md-6 col-lg-6 {{$errors->has('school') ? ' is-invalid' : '' }}" required>
            @foreach($schools as $school)
            @if($user->school == $school->name)
            <option value="{{$school->name}}" selected>{{$school->name}}</option>
            @else
            <option value="{{$school->name}}">{{$school->name}}</option>
            @endif
            @endforeach
          </select>
          @if($errors->has('school'))
          <span class="invalid-feedback" role="alert">
            <strong>{{$errors->first('school')}}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="avatar">Imagem de perfil (opcional)</label>
          <input type="file" id="avatar" name="avatar" class="form-control {{$errors->has('avatar') ? ' is-invalid' : ''}}" accept="image/png, image/jpeg">
          @if ($errors->has('avatar'))
           <span class="invalid-feedback" role="alert">
             <strong>{{$errors->first('avatar')}}</strong>
           </span>
          @endif
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
