@extends('layouts.dashboard', ['dash_class' => 'geral'])
@section('title','Visão geral - SAPO')
@section('content')
<div class="content-wrapper">
  <br>
  <h1>Avaliações - Visão geral</h1>
  <br>
  @if(session()->get('success'))
    <div class="alert alert-warning">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped text-center">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Disciplina</th>
        <th scope="col">Anos</th>
        <th scope="col">Importação</th>
        <th scope="col">Visualizar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($avaliacoes as $avaliacao)
      <tr>
        <td class="text-left">{{$avaliacao->idProva}}</td>
        <td>{{$avaliacao->materia}}</td>
        <td>
          @if($avaliacao->turma == "AI")
          Iniciais
          @elseif($avaliacao->turma == "AF")
          Finais
          @endif
        </td>
        <td>
          @if($avaliacao->fonteDados == "GF")
          <i class="fab fa-google-drive"></i>
          @elseif($avaliacao->fonteDados == "AP")
          <i class="fas fa-file-csv"></i>
          @endif
        </td>
        <td>
          <a href="{{URL::to('geral/'.$avaliacao->id.'/resultado')}}" class="btn btn-primary fab fa-readme" style="font-size: 14px;"></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
