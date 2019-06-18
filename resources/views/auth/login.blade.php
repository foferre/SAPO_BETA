@extends('layouts.logintemplate')

@section('content')
  <div class="row h-100 justify-content-center align-items-center">
      <div class="col-md-4">
          <img class="rounded mx-auto d-block" src="{{URL::to('img/Frog_Hat_Chart.png')}}" alt="Login | SAPO" width="108" height="108">
          <br>
          <div class="card">
              <div class="card-body">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Usuário" required autofocus>
                          @if ($errors->has('username'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                          </span>
                          @endif
                      </div>

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-key"></i></span>
                          </div>
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Senha" required>
                          @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                          @endif
                      </div>

                      <div class="form-check mb-3">
                          <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              &nbspLembre de mim!
                          </label>
                      </div>

                      <div class="row">
                          <div class="col">
                              <button type="submit" class="btn btn-block btn-success">Entrar</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
