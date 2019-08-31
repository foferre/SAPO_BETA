@extends('layouts.dashboard', ['dash_class' => 'geral'])
@section('title','Visão geral - SAPO')
@section('content')
<h2>Avaliações - Visão geral</h2>
<br>
@if(session()->get('success'))
  <div class="alert alert-warning">
    {{ session()->get('success') }}
  </div><br />
@endif
  <div class="card mb-4">
    <div class="card-body">
      <table id="tabela" class="table table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Turma</th>
            <th scope="col">Dados</th>
            <th class="actions">Visualizar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($exams as $exam)
          <tr>
            <td class="text-left">{{$exam->idExam}}</td>
            <td>{{$exam->subject}}</td>
            <td>{{$exam->class}}</td>
            <td>
              @if($exam->source == "GF")
              <i class="fab fa-google-drive"></i>
              @elseif($exam->source == "AP")
              <i class="fas fa-file-csv"></i>
              @endif
            </td>
            <td>
              <a href="{{URL::to('geral/'.$exam->id.'/resultado')}}" class="btn btn-primary fab fa-readme" style="font-size: 14px;"></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <script src="{{URL::to('js/datatables/language.js')}}"></script>
@endsection
