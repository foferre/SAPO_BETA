<?php

namespace App\Http\Controllers\Dashboard\Escolas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

use App\Exams;
use App\Descriptors;
use App\Schools;
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

class SchoolController extends Controller
{
  public function resGeral()
  {
    if(Gate::allows('isAdmin') || Gate::allows('isGeneral'))
    {
      $exams = Exams::all();
    }else{
      $exams = Exams::where('scope','=','Geral')->orWhere('scope','=',Auth()->user()->school)->get();
    }
    return view('dashboard.escolas.resultado_geral', compact('exams'));
  }

  public function schoolQuery($id)
  {
    $exam = Exams::find($id);
    $schools = Schools::all();
    return view('dashboard.escolas.buscar_escola', compact('exam', 'schools'));
  }

  public function resShow($id)
  {
    $idExam = $request->get('id');
    $schools = $request->get('schools');
    $school = Schools::find($schools);
    $subject = $exam->subject;
    $class = $exam->class;
    $source = $exam->source;

    if ($subject == 'Matemática'){
      if ($class == '4') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Math_4::where($match)->count();
        $exams = Math_4::where($match)->get();
      }
      if ($class == '5') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Math_5::where($match)->count();
        $exams = Math_5::where($match)->get();
      }
      if ($class == '6') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Math_6::where($match)->count();
        $exams = Math_6::where($match)->get();
      }
      if ($class == '7') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Math_7::where($match)->count();
        $exams = Math_7::where($match)->get();
      }
      if ($class == '8') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Math_8::where($match)->count();
        $exams = Math_8::where($match)->get();
      }
      if ($class == '9') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Math_9::where($match)->count();
        $exams = Math_9::where($match)->get();
      }
    }elseif ($subject == 'Português'){
      if ($class == '4') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Port_4::where($match)->count();
        $exams = Port_4::where($match)->get();
      }
      if ($class == '5') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Port_5::where($match)->count();
        $exams = Port_5::where($match)->get();
      }
      if ($class == '6') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Port_6::where($match)->count();
        $exams = Port_6::where($match)->get();
      }
      if ($class == '7') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Port_7::where($match)->count();
        $exams = Port_7::where($match)->get();
      }
      if ($class == '8') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Port_8::where($match)->count();
        $exams = Port_8::where($match)->get();
      }
      if ($class == '9') {
        $match = ['idExam' => $exam->idExam, 'school' => $school->name];
        $amount = Port_9::where($match)->count();
        $exams = Port_9::where($match)->get();
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
      return view('dashboard.escolas.visualizar', compact('exam', 'amount', 'average', 'hit', 'totalHit', 'miss', 'total', 'descriptors'));
    } catch (\Exception $e) {
      return redirect('dashboard/escolas/visualizar')->with('success', 'Nenhum resultado encontrado!');
    }
  }

  public function descGeral()
  {
    if(Gate::allows('isAdmin'))
    {
      $exams = Exams::all();
    }else{
      $exams = Exams::where('scope','=','Geral')->orWhere('scope','=',Auth()->user()->school)->get();
    }
    return view('dashboard.geral.descritor_geral', compact('exams'));
  }

  public function descShow($id)
  {
    $exam = Exams::find($id);
    $subject = $exam->subject;
    $class = $exam->class;
    $source = $exam->source;

    if ($subject == 'Matemática'){
      if ($class == '4') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Math_4::where('idExam','=',$exam->idExam)->count();
          $exams = Math_4::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Math_4::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Math_4::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '5') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Math_5::where('idExam','=',$exam->idExam)->count();
          $exams = Math_5::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Math_5::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Math_5::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '6') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Math_6::where('idExam','=',$exam->idExam)->count();
          $exams = Math_6::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Math_6::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Math_6::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '7') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Math_7::where('idExam','=',$exam->idExam)->count();
          $exams = Math_7::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Math_7::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Math_7::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '8') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Math_8::where('idExam','=',$exam->idExam)->count();
          $exams = Math_8::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Math_8::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Math_8::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '9') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Math_9::where('idExam','=',$exam->idExam)->count();
          $exams = Math_9::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Math_9::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Math_9::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
    }elseif ($subject == 'Português'){
      if ($class == '4') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Port_4::where('idExam','=',$exam->idExam)->count();
          $exams = Port_4::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Port_4::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Port_4::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '5') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Port_5::where('idExam','=',$exam->idExam)->count();
          $exams = Port_5::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Port_5::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Port_5::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '6') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Port_6::where('idExam','=',$exam->idExam)->count();
          $exams = Port_6::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Port_6::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Port_6::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '7') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Port_7::where('idExam','=',$exam->idExam)->count();
          $exams = Port_7::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Port_7::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Port_7::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '8') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Port_8::where('idExam','=',$exam->idExam)->count();
          $exams = Port_8::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Port_8::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Port_8::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
      if ($class == '9') {
        if(Gate::allows('isAdmin') || Gate::allows('isGeneral')){
          $amount = Port_9::where('idExam','=',$exam->idExam)->count();
          $exams = Port_9::where('idExam','=',$exam->idExam)->get();
        }else{
          $amount = Port_9::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->count();
          $exams = Port_9::where('idExam','=',$exam->idExam)->where('school','=',Auth()->user()->school)->get();
        }
      }
    }

    $hit = array();
    $miss = array();
    $descriptors = array();
    $description = array();
    $alternative = array();
    $totalQuestion = array();
    $totalHit = 0;
    $total = 0;

    for ($i=1; $i <= $exam->qNumber; $i++){
      $hit[$i] = 0;
      $miss[$i] = 0;
      $descriptors[$i] = $i.') '.$exam['d'.$i];
      $desc = Descriptors::where('idDescriptor','=',$exam['d'.$i])->where('class','=',$class)->where('subject','=',$subject)->first();
      $description[$i] = $desc->description;
      for ($j=1; $j <= 5; $j++) {
        $alternative[$i][$j] = 0;
      }
      $totalQuestion[$i] = 0;
    }

    try {
      if ($source == "gf") {
        foreach ($exams as $test) {
          for ($i=1; $i <= $exam->qNumber ; $i++){
            if (substr($test['q'.$i],1,1) == $exam['q'.$i]){
              $hit[$i]++;
              $totalHit++;
            }else{
              $miss[$i]++;
            }
            if(substr($test['q'.$i],1,1) == 'A'){
              $alternative[$i][1]++;
            }elseif(substr($test['q'.$i],1,1) == 'B'){
              $alternative[$i][2]++;
            }elseif(substr($test['q'.$i],1,1) == 'C'){
              $alternative[$i][3]++;
            }elseif(substr($test['q'.$i],1,1) == 'D'){
              $alternative[$i][4]++;
            }else {
              $alternative[$i][5]++;
            }
            $totalQuestion[$i]++;
            $total++;
          }
        }
        $average = round(($totalHit / $total)*100);
      }elseif ($source == "ap") {
        foreach ($exams as $test) {
          for ($i=1; $i <= $exam->qNumber ; $i++){
            if ($test['q'.$i] == $exam['q'.$i]){
              $hit[$i]++;
              $totalHit++;
            }else{
              $miss[$i]++;
            }
            if($test['q'.$i] == 'A'){
              $alternative[$i][1]++;
            }elseif($test['q'.$i] == 'B'){
              $alternative[$i][2]++;
            }elseif($test['q'.$i] == 'C'){
              $alternative[$i][3]++;
            }elseif($test['q'.$i] == 'D'){
              $alternative[$i][4]++;
            }else {
              $alternative[$i][5]++;
            }
            $totalQuestion[$i]++;
            $total++;
          }
        }
        $average = round(($totalHit / $total)*100);
      }
      return view('dashboard.geral.descritores', compact('exam', 'amount', 'average', 'hit', 'totalHit', 'miss', 'total', 'descriptors','description', 'alternative', 'totalQuestion'));
    } catch (\Exception $e) {
      return redirect('dashboard/geral/descritor_geral')->with('success', 'Nenhum resultado encontrado!');
    }
  }
}
