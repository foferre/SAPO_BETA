<?php

namespace App\Http\Controllers\Dashboard\Alunos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Session;

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

class StudentController extends Controller
{
  public function resGeral()
  {
    if(Gate::allows('isAdmin') || Gate::allows('isGeneral'))
    {
      $exams = Exams::all();
    }else{
      $exams = Exams::where('scope','=','Geral')->orWhere('scope','=',Auth()->user()->school)->get();
    }
    return view('dashboard.alunos.avaliacoes', compact('exams'));
  }

  public function studentQuery($id)
  {
    if(Gate::allows('isAdmin') || Gate::allows('isGeneral'))
    {
      $schools = Schools::all();
    }else{
      $schools = Schools::where('name','=',Auth()->user()->school)->get();
    }
    $exam = Exams::find($id);
    return view('dashboard.alunos.buscar_aluno', compact('exam', 'schools'));
  }

  public function studentShow(Request $request)
  {
    if(Gate::allows('isAdmin') || Gate::allows('isGeneral'))
    {
      $schools = Schools::all();
    }else{
      $schools = Schools::where('name','=',Auth()->user()->school)->get();
    }
    $currentschool = $request->get('school');
    $currentclass = $request->get('class');
    $currentstudent = $request->get('student');
    if($request->get('student') == null){
      $currentstudent = "";
    }
    $idExam = $request->get('exam');
    $exam = Exams::find($idExam);
    $subject = $exam->subject;
    $class = $exam->class;

    if ($subject == 'Matemática'){
      if ($class == '4') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Math_4::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '5') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Math_5::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '6') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Math_6::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '7') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Math_7::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '8') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Math_8::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '9') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Math_9::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
    }elseif ($subject == 'Português'){
      if ($class == '4') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Port_4::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '5') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Port_5::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '6') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Port_6::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '7') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Port_7::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '8') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Port_8::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '9') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $exams = Port_9::where('student', 'like', '%'.$currentstudent.'%')->where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
    }
    $request->session()->forget('success');
    $request->session()->forget('error');
    Session::flash('success', 'Busca efetuada com sucesso!');
    return view('dashboard.alunos.buscar_aluno', compact('exams', 'exam', 'schools', 'currentschool', 'currentclass', 'currentstudent'));
  }

  public function showTemplate($id, $subject, $class, $idExam)
  {
    if(Gate::allows('isAdmin') || Gate::allows('isGeneral'))
    {
      $schools = Schools::all();
    }else{
      $schools = Schools::where('name','=',Auth()->user()->school)->get();
    }


    if ($subject == 'Matemática'){
      if ($class == '4') {
        $answers = Math_4::find($id);
      }
      if ($class == '5') {
        $answers = Math_5::find($id);
      }
      if ($class == '6') {
        $answers = Math_6::find($id);
      }
      if ($class == '7') {
        $answers = Math_7::find($id);
      }
      if ($class == '8') {
        $answers = Math_8::find($id);
      }
      if ($class == '9') {
        $answers = Math_9::find($id);
      }
    }elseif ($subject == 'Português'){
      if ($class == '4') {
        $answers = Port_4::find($id);
      }
      if ($class == '5') {
        $answers = Port_5::find($id);
      }
      if ($class == '6') {
        $answers = Port_6::find($id);
      }
      if ($class == '7') {
        $answers = Port_7::find($id);
      }
      if ($class == '8') {
        $answers = Port_8::find($id);
      }
      if ($class == '9') {
        $answers = Port_9::find($id);
      }
    }

    $exam = Exams::find($idExam);
    $hit = array();
    $miss = array();
    $descriptors = array();
    $description = array();
    $totalHit = 0;
    $totalMiss = 0;
    $total = 0;

    for ($i=1; $i <= $exam->qNumber; $i++){
      $hit[$i] = 0;
      $miss[$i] = 0;
      $descriptors[$i] = $i.') '.$exam['d'.$i];
      $desc = Descriptors::where('idDescriptor','=',$exam['d'.$i])->where('class','=',$class)->where('subject','=',$subject)->first();
      $description[$i] = $desc->description;
    }

    try {
      if ($exam->source == "gf") {
        for ($i=1; $i <= $exam->qNumber ; $i++){
          if (substr($answers['q'.$i],1,1) == $exam['q'.$i]){
            $hit[$i]++;
            $totalHit++;
          }else{
            $miss[$i]++;
          }
          $total++;
        }
        $average = round(($totalHit / $total)*100);
      }elseif ($exam->source == "ap") {
        for ($i=1; $i <= $exam->qNumber ; $i++){
          if ($answers['q'.$i] == $exam['q'.$i]){
            $hit[$i]++;
            $totalHit++;
          }else{
            $miss[$i]++;
          }
          $total++;
        }
        $average = round(($totalHit / $total)*100);
      }
      Session::flash('success', 'Busca efetuada com sucesso!');
      return view ('dashboard.alunos.boletim', compact('exam', 'schools', 'answers', 'descriptors', 'description', 'hit', 'miss', 'totalHit', 'totalMiss', 'total', 'average'));
    } catch (\Exception $e) {
      Session::flash('error', 'Nenhum resultado encontrado!');
      return view('/dashboard/alunos/buscar_aluno', compact('exam', 'schools'));
    }
  }

  public function descQuery($id)
  {
    $exam = Exams::find($id);
    $schools = Schools::all();
    return view('dashboard.turmas.descritores', compact('exam', 'schools'));
  }

  public function descShow(Request $request)
  {
    $idExam = $request->get('exam');
    $exam = Exams::find($idExam);
    $currentschool = $request->get('school');
    $currentclass = $request->get('class');
    $schools = Schools::all();
    $subject = $exam->subject;
    $class = $exam->class;
    $source = $exam->source;

    if ($subject == 'Matemática'){
      if ($class == '4') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Math_4::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Math_4::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '5') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Math_5::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Math_5::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '6') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Math_6::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Math_6::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '7') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Math_7::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Math_7::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '8') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Math_8::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Math_8::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '9') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Math_9::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Math_9::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
    }elseif ($subject == 'Português'){
      if ($class == '4') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Port_4::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Port_4::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '5') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Port_5::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Port_5::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '6') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Port_6::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Port_6::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '7') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Port_7::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Port_7::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '8') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Port_8::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Port_8::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
      }
      if ($class == '9') {
        $match = ['idExam' => $exam->idExam, 'school' => $currentschool];
        $amount = Port_9::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->count();
        $exams = Port_9::where('class', 'like', $exam->class.'%'.$currentclass)->where($match)->get();
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
      $request->session()->forget('success');
      $request->session()->forget('error');
      Session::flash('success', 'Busca efetuada com sucesso!');
      return view('dashboard.turmas.descritores', compact('exam', 'exams', 'currentschool', 'currentclass','schools', 'amount', 'average', 'hit', 'totalHit', 'miss', 'total', 'descriptors','description', 'alternative', 'totalQuestion'));
    } catch (\Exception $e) {
      $request->session()->forget('success');
      $request->session()->forget('error');
      Session::flash('error', 'Nenhum resultado encontrado!');
      return view('dashboard/turmas/descritores', compact('exam', 'schools'));
    }
  }
}
