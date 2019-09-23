@extends('layouts.dashboard', ['active' => 'class'])
@section('title','Visão geral - SAPO')
@section('content')
<div class="container">
  <br>
  <h3>Avaliações - Visão geral</h3>
  <br>
  @if(session()->get('success'))
    <div class="alert alert-warning">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <div class="card mb-4">
    <div class="card-body">
      <table id="tabela" class="table table-hover table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Série/Ano</th>
            <th scope="col">Dados</th>
            <th class="actions">Visualizar</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @foreach ($exams as $exam)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$exam->idExam}}</td>
            <input type="hidden" name="id" value="{{$exam->id}}}">
            <td>{{$exam->subject}}</td>
            <td>{{$exam->class}}º Ano</td>
            @if($exam->source == "gf")
            <td><i class="fab fa-google-drive fa-2x"></i></td>
            @elseif($exam->source == "ap")
            <td><i class="fas fa-file-csv fa-2x"></i></td>
            @endif
            <td>
              <a href="{{URL::to('/dashboard/turmas/'.$exam->id.'/buscar_escola')}}" class="btn btn-primary fab fa-readme"></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <script src="{{URL::to('js/datatables/language.js')}}"></script>
    </div>
  </div>
</div>
@endsection
