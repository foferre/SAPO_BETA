@extends('layouts.dashboard', ['active' => 'student'])
@section('title','Boletim - SAPO')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <h1 class="text-center">Boletim</h1>
    </div>
  </div>
  <hr>
  <div class="row">
    <div id="boletim" class="card border-dark mb-3 col-lg-6 col-md-6 col-sm-10" style="max-width: 54rem;">
      <div class="card-header bg-white">
        Aluno: {{$answers->student}}
      </div>
      <div class="card-header bg-white">
        Escola: {{$answers->school}}
        <span class="float-right">Turma: {{$answers->class}}</span>
      </div>
      <div class="card-header bg-white">
        Avaliação: {{$answers->idExam}}
        <span class="float-right">Nota: <b>{{$average/10}}</b></span>
      </div>
      <div class="card-header text-center bg-white">
        <h3><b>Gabarito</b></h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
            <table class="table table-bordered table-striped table-fit">
              <thead>
                <tr>
                  <th class="text-center">Bloco 1</th>
                  <th class="text-center">Resposta</th>
                </tr>
              </thead>
              <tbody>
                @for($i = 1; $i <= $exam->qNumber/2; $i++)
                @if($hit[$i] == 1)
                <tr>
                  <td class="text-center table-success">{{$i}}</td>
                  @if($exam->source == "gf")
                  <td class="text-center table-success" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{substr($answers['q'.$i],1,1)}}</td>
                  @elseif($exam->source == "ap")
                  <td class="text-center table-success" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{$answers['q'.$i]}}</td>
                  @endif
                </tr>
                @else
                <tr>
                  <td class="text-center table-danger">{{$i}}</td>
                  @if($exam->source == "gf")
                  <td class="text-center table-danger" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{substr($answers['q'.$i],1,1)}}</td>
                  @elseif($exam->source == "ap")
                  <td class="text-center table-danger" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{$answers['q'.$i]}}</td>
                  @endif
                </tr>
                @endif
                @endfor
              </tbody>
            </table>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
            <table class="table table-bordered table-striped table-fit">
              <thead>
                <tr>
                  <th class="text-center">Bloco 2</th>
                  <th class="text-center">Resposta</th>
                </tr>
              </thead>
              <tbody>
                @for($i; $i <= $exam->qNumber; $i++)
                @if($hit[$i] == 1)
                <tr>
                  <td class="text-center table-success">{{$i}}</td>
                  @if($exam->source == "gf")
                  <td class="text-center table-success" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{substr($answers['q'.$i],1,1)}}</td>
                  @elseif($exam->source == "ap")
                  <td class="text-center table-success" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{$answers['q'.$i]}}</td>
                  @endif
                </tr>
                @else
                <tr>
                  <td class="text-center table-danger">{{$i}}</td>
                  @if($exam->source == "gf")
                  <td class="text-center table-danger" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{substr($answers['q'.$i],1,1)}}</td>
                  @elseif($exam->source == "ap")
                  <td class="text-center table-danger" data-toggle="tooltip" data-placement="right" title="{{$descriptors[$i]}} - {{$description[$i]}}">{{$answers['q'.$i]}}</td>
                  @endif
                </tr>
                @endif
                @endfor
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2">
      <button id="boletimPNG" class='btn btn-primary exportButton' onClick='downloadBoletimPNG()'><i class='fas fa-download fa-1x'></i> PNG</button>
    </div>
  </div>
</div>
<script src="{{URL::to('js/template/html2canvas.min.js')}}"></script>
<script src="{{URL::to('js/template/filesaver.min.js')}}"></script>
<script>
  var name = "{{$answers->student}}";
  var exam = "{{$answers->idExam}}";
</script>
<script src="{{URL::to('js/downloads/downloadBoletim.js')}}"></script>
@endsection
