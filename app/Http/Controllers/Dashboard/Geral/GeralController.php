<?php

namespace App\Http\Controllers\Dashboard\Geral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

use App\Exams;
use App\Descriptors;
use App\Math_4;
use App\Math_5;
use App\Math_6;
use App\Math_7;
use App\Math_8;
use App\Math_9;
use App\Port_4;
use App\Port_5;
use App\Port_6;
use App\Port_7;
use App\Port_8;
use App\Port_9;

class GeralController extends Controller
{
  public function resGeral()
  {
    if(Gate::allows('isAdmin'))
    {
      $exams = Exams::all();
    }else{
      $exams = Exams::where('scope','=','0')->orWhere('scope','=',Auth()->user()->school)->get();
    }
    return view('dashboard.geral.resultado_geral', compact('exams'));
  }

  public function resShow($id)
  {
    $exam = Exams::find($id);
    $subject = $exam->subject;
    $class = $exam->class;
    $source = $exam->source;

    if ($subject == 'Matemática'){
      if ($class == '4') {
        $amount = Math_4::where('idExam','=',$exam->idExam)->count();
        $exams = Math_4::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '5') {
        $amount = Math_5::where('idExam','=',$exam->idExam)->count();
        $exams = Math_5::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '6') {
        $amount = Math_6::where('idExam','=',$exam->idExam)->count();
        $exams = Math_6::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '7') {
        $amount = Math_7::where('idExam','=',$exam->idExam)->count();
        $exams = Math_7::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '8') {
        $amount = Math_8::where('idExam','=',$exam->idExam)->count();
        $exams = Math_8::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '9') {
        $amount = Math_9::where('idExam','=',$exam->idExam)->count();
        $exams = Math_9::where('idExam','=',$exam->idExam)->get();
      }
    }elseif ($subject == 'Português'){
      if ($class == '4') {
        $amount = Port_4::where('idExam','=',$exam->idExam)->count();
        $exams = Port_4::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '5') {
        $amount = Port_5::where('idExam','=',$exam->idExam)->count();
        $exams = Port_5::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '6') {
        $amount = Port_6::where('idExam','=',$exam->idExam)->count();
        $exams = Port_6::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '7') {
        $amount = Port_7::where('idExam','=',$exam->idExam)->count();
        $exams = Port_7::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '8') {
        $amount = Port_8::where('idExam','=',$exam->idExam)->count();
        $exams = Port_8::where('idExam','=',$exam->idExam)->get();
      }
      if ($class == '9') {
        $amount = Port_9::where('idExam','=',$exam->idExam)->count();
        $exams = Port_9::where('idExam','=',$exam->idExam)->get();
      }
    }

    $hit = array();
    $miss = array();
    $descriptors = array();
    $totalHit = 0;
    $total = 0;

    for ($i=1; $i <= $exam->qNumber; $i++){
      $hit[$i] = 0;
      $miss[$i] = 0;
      $descriptors[$i] = $i.') '.$exam['d'.$i];
    }

    try {
      if ($source == "gf") {
        foreach ($exams as $test) {
          for ($i=1; $i <= $exam->qNumber ; $i++){
            if (substr($test['q'.$i],1,1) == $exam['q'.$i]){
              $hit[$i]++;
              $totalHit++;
              $total++;
            }else{
              $miss[$i]++;
              $total++;
            }
          }
        }
        $average = round(($totalHit / $total)*100);
      }elseif ($source == "ap") {
        foreach ($exams as $test) {
          for ($i=1; $i <= $exam->qNumber ; $i++){
            if ($test['q'.$i] == $exam['q'.$i]){
              $hit[$i]++;
              $totalHit++;
              $total++;
            }else{
              $miss[$i]++;
              $total++;
            }
          }
        }
        $average = round(($totalHit / $total)*100);
      }
      return view('dashboard.geral.visualizar', compact('exam', 'amount', 'average', 'hit', 'totalHit', 'miss', 'total', 'descriptors'));
    } catch (\Exception $e) {
      return redirect('dashboard/geral/resultado_geral')->with('success', 'Nenhum resultado encontrado!');
    }
  }
}
