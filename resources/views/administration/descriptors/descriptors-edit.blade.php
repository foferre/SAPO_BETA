@extends('layouts.administration', ['active' => 'descriptors'])
@section('title','Editar avaliação - SAPO')
@section('content')
<div class="content-wrapper">
  <br>
  <h3>Editar descritor</h3>
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
            <th scope="col">ID</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Série</th>
            <th class="actions">Editar</th>
            <th class="actions">Excluir</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($math_descs as $math_desc)
          <tr>
            <td>{{$math_desc->id}}</td>
            <td>{{$math_desc->idDescriptor}}</td>
            <td>Matemática</td>
            <td>{{$math_desc->class}}ª Série</td>
            <td><a href="{{route('descritor.edit', $math_desc)}}" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-fw fa-edit"></i></a></td>
            <td>
              <form action="{{route('descritor.destroy', $math_desc)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o descritor {{$math_desc->idDescriptor}}?')"><i class="fa fa-fw fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
          @foreach ($port_descs as $port_desc)
          <tr>
            <td>{{$port_desc->id}}</td>
            <td>{{$port_desc->idDescriptor}}</td>
            <td>Português</td>
            <td>{{$port_desc->class}}ª Série</td>
            <td><a href="{{route('descritor.edit', $port_desc)}}" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-fw fa-edit"></i></a></td>
            <td>
              <form action="{{route('descritor.destroy', $port_desc)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o descritor {{$port_desc->idDescriptor}}?')"><i class="fa fa-fw fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <script src="{{URL::to('js/datatables/language.js')}}"></script>
@endsection
