<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Exams;
use App\Schools;
use App\Subject;
use App\Source;
use App\Grade;

class ExamController extends Controller
{
  public function index() //exams-edit
  {
    $exams = Exams::all();
    return view('administration.exams.exams-edit', compact('exams'));
  }

  public function show() //exams-edit
  {
    $exams = Exams::all();
    return view('administration.exams.exams-edit', compact('exams'));
  }

  public function create() //exams-create
  {
    $schools = Schools::all();
    $subjects = Subject::all();
    $sources = Source::all();
    $grades = Grade::all();
    return view('administration.exams.exams-create', compact('schools', 'subjects', 'sources', 'grades'));
  }

  public function store(Request $request)
  {
    $this->validate($request,[
      'idExam'=>'required|unique:exams',
      'subject'=>'required',
      'qNumber'=>'required|numeric|max:30',
      'class'=>'required',
      'scope'=>'required',
      'source'=>'required',
      'description' => 'required',
    ]);

    $exam = new Exams([
      'idExam' => $request->get('idExam'),
      'subject' => $request->get('subject'),
      'qNumber' => $request->get('qNumber'),
      'class' => $request->get('class'),
      'scope' => $request->get('scope'),
      'source' => $request->get('source'),
      'description' => $request->get('description'),
    ]);

    for($i=1; $i <= $request->get('qNumber'); $i++){
      $exam['q'.$i] = $request->get('q'.$i);
      $exam['d'.$i] = $request->get('d'.$i);
    }

    if($exam->save()){
      Session::flash('success', 'Avaliação "'.$exam->idExam.'" cadastrada com sucesso!');
      return back();
    }else{
      Session::flash('error', 'Falha ao registrar avaliação!');
      return back();
    }
  }

  public function edit($id)
  {
    $schools = Schools::all();
    $exam = Exams::find($id);
    $subjects = Subject::all();
    $sources = Source::all();
    $grades = Grade::all();
    return view('administration.exams.edit', compact('exam', 'schools', 'subjects', 'sources', 'grades'));
  }

  public function update(Request $request, $id)
  {
    $exam = Exams::find($id);

    if($request->get('idExam') == $exam->idExam){
      $this->validate($request,[
        'idExam'=>'required',
        'subject'=>'required',
        'qNumber'=>'required|numeric',
        'class'=>'required',
        'scope'=>'required',
        'source'=>'required',
        'description' => 'required',
      ]);
    }else{ //Caso haja alteração na idExam, irá aceitar apenas se não existir outra idExam igual
      $this->validate($request,[
        'idExam'=>'required|unique:exams',
        'subject'=>'required',
        'qNumber'=>'required|numeric',
        'class'=>'required',
        'scope'=>'required',
        'source'=>'required',
        'description' => 'required',
      ]);
    }

    $exam->idExam = $request->get('idExam');
    $exam->subject = $request->get('subject');
    $exam->qNumber = $request->get('qNumber');
    $exam->class = $request->get('class');
    $exam->scope = $request->get('scope');
    $exam->source = $request->get('source');
    $exam->description = $request->get('description');

    //Insere na $exam o gabarito de questões e descritores de acordo com o número de questões passados
    for($i=1; $i <= $request->get('qNumber'); $i++){
      $exam['q'.$i] = $request->get('q'.$i);
      $exam['d'.$i] = $request->get('d'.$i);
    }

    if($exam->save()){
      return redirect('avaliacao/index')->with('success', 'Alterações salvas com sucesso!');
    }else{
      return redirect('avaliacao/index')->with('success', 'Falha ao salvar alterações!');
    }
  }

  public function destroy($id)
  {
    $exam = Exams::find($id);
    if($exam->delete()){
      Session::flash('success', 'Avaliação "'.$exam->idExam.'" removida!');
      return back();
    }else{
      Session::flash('error', 'Erro ao remover avaliação "'.$exam->idExam.'"');
      return back();
    }
  }
}
