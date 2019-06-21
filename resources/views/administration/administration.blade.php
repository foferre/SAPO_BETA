@extends('layouts.administration', ['dash_class' => 'profile'])
@section('title','Visão geral - SAPO')
@section('content')
<div class="container">
  <div class="row my-2">
    <!-- Abas -->
    <div class="col-lg-8 order-lg-2">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Perfil</a>
        </li>
        <li class="nav-item">
          <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Editar</a>
        </li>
      </ul>
      <!-- Perfil -->
      <div class="tab-content py-4">
        <div class="tab-pane active" id="profile">
          <h5 class="mb-3">{{Auth::user()->name}}</h5>
          <div class="row">
            <div class="col-md-6">
              <h6><b>Escola</b></h6>
              <p>{{$schoolName->name}}</p>
              <br>
              <h6><b>Nível de acesso</b></h6>
              <br>
              <p>
                @if(Auth::user()->type == "admin")
                <span class="alert alert-primary"><i class="fas fa-user-shield"></i> Administrador</span>
                @elseif(Auth::user()->type == "general")
                <span class="alert alert-success"><i class="fa fa-user"></i> Geral</span>
                @elseif(Auth::user()->type == "school")
                <span class="alert alert-danger"><i class="fas fa-graduation-cap"></i> Escola</span>
                @endif
              </p>
            </div>
            <div class="col-md-6">
              <h6><b>Usuário</b></h6>
              <h6>{{Auth::user()->username}}</h6>
              <hr>
            </div>
          </div>
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
          @elseif(!$errors->isEmpty())
          <div class="alert alert-danger alert-dismissible" role="alert">
            Falha ao salvar alterações!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>
        <!--Editar-->
        <div class="tab-pane" id="edit">
          <form role="form" method="POST" action="{{route('administracao.update', Auth::user()->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Nome</label>
              <div class="col-lg-9">
                <input type="text" id="name" name="name" class="form-control {{$errors->has('name') ? ' is-invalid' : ''}}"  value="{{Auth::user()->name}}" required>
                @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first('name')}}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Escola</label>
              <div class="col-lg-9">
                <select id="school" name="school" class="form-control" required>
                  @foreach($schools as $school)
                  @if(Auth::user()->school == $school->id)
                  <option value="{{$school->id}}" selected>{{$school->name}}</option>
                  @else
                  <option value="{{$school->id}}">{{$school->name}}</option>
                  @endif
                  @endforeach
                </select>
                @if($errors->has('school'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first('school')}}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Nível de acesso</label>
              <div class="col-lg-9">
                <select id="type" name="type" class="form-control" required>
                  @foreach($types as $type)
                  @if(Auth::user()->type == $type->name)
                  <option value="{{$type->name}}" selected>{{$type->description}}</option>
                  @else
                  <option value="{{$type->name}}">{{$type->description}}</option>
                  @endif
                  @endforeach
                </select>
                @if($errors->has('type'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first('type')}}</strong>
                  </span>
                @endif
              </div>
            </div>
            <hr>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Nome de usuário</label>
              <div class="col-lg-9">
                <input type="text" id="username" name="username" class="form-control {{$errors->has('username') ? ' is-invalid' : ''}}" value="{{Auth::user()->username}}" required>
                @if ($errors->has('username'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first('username')}}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Nova senha</label>
              <div class="col-lg-9">
                <input type="password" id="password" name="password" class="form-control {{$errors->has('password') ? ' is-invalid' : ''}}" placeholder="Digite uma nova senha">
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first('password')}}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Confirmar senha</label>
              <div class="col-lg-9">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirme sua nova senha">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Imagem de perfil (opcional)</label>
              <div class="col-md-9">
                 <input type="file" id="avatar" name="avatar" class="form-control" >
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label"></label>
              <div class="col-lg-9">
                <input type="reset" class="btn btn-secondary" value="Cancelar">
                <input type="submit" class="btn btn-success" value="Salvar mudanças">
              </div>
            </div>
          </form>
        </div>
    </div>
      </div>
      <div class="col-lg-4 order-lg-1 text-center">
          <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
          <h6 class="mt-2">{{Auth::user()->name}}</h6>
      </div>
  </div>
</div>
@endsection
