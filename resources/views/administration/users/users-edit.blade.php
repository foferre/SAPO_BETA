@extends('layouts.administration', ['active' => 'users'])
@section('title','Editar usuários - SAPO')
@section('content')
<div class="content-wrapper">
  <br>
  <h3>Editar usuários</h3>
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
      <table id="tabela" class="table table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Usuário</th>
            <th scope="col">Nome</th>
            <th scope="col">Escola</th>
            <th scope="col">Acesso</th>
            <th class="actions">Editar</th>
            <th class="actions">Excluir</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @foreach ($users as $user)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->school}}</td>
            <td>{{$user->type}}</td>
            <td><a href="{{route('usuario.edit', $user->id)}}" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-fw fa-edit"></i></a></td>
            <td>
              <form action="{{route('usuario.destroy', $user->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o usuário {{$user->username}}?')"><i class="fa fa-fw fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <script src="{{URL::to('js/datatables/language.js')}}"></script>
@endsection
