@extends('layouts.administration', ['active' => 'exams'])
@section('title','Editar avaliação - SAPO')
@section('content')
<div class="content-wrapper">
  <br>
  <h3>Editar avaliação</h3>
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
            <th scope="col">Dados</th>
            <th class="actions">Editar</th>
            <th class="actions">Excluir</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($exams as $exam)
          <tr>
            <td>{{$exam->id}}</td>
            <td>{{$exam->idExam}}</td>
            @if($exam->subject == "math")
            <td>Matemática</td>
            @elseif($exam->subject == "port")
            <td>Português</td>
            @endif
            <td>{{$exam->class}}ª Série</td>
            @if($exam->source == "gf")
            <td><i class="fab fa-google-drive fa-2x"></i></td>
            @elseif($exam->source == "ap")
            <td><i class="fab fa-android fa-2x"></i></td>
            @endif
            <td><a href="{{route('avaliacao.edit', $exam->id)}}" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-fw fa-edit"></i></a></td>
            <td>
              <form action="{{route('avaliacao.destroy', $exam->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir a avaliação {{$exam->idExam}}?')"><i class="fa fa-fw fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <script src="{{URL::to('js/datatables/language.js')}}"></script>
@endsection
