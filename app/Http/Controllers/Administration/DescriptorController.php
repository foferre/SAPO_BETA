<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Math_desc;
use App\Port_desc;
use App\Grade;
use App\Subject;

class DescriptorController extends Controller
{
  public function index() //descriptors-edit
  {
    $math_descs = Math_desc::all();
    $port_descs = Port_desc::all();
    $subjects = Subject::all();
    return view('administration.descriptors.descriptors-edit', compact('math_descs', 'port_descs', 'subjects'));
  }

  public function show() //descriptors-edit
  {
    $math_descs = Math_desc::all();
    $port_descs = Port_desc::all();
    $subjects = Subject::all();
    return view('administration.descriptors.descriptors-edit', compact('math_descs', 'port_descs', 'subjects'));
  }

  public function create() //descriptors-create
  {
    $grades = Grade::all();
    $subjects = Subject::all();
    return view('administration.descriptors.descriptors-create', compact('grades', 'subjects'));
  }

  public function store(Request $request)
  {
    $this->validate($request,[
      'idDescriptor'=>'required',
      'class'=>'required',
      'subject'=>'required',
      'description' => 'required',
    ]);

    switch($request->subject){
      case 'math':
        $descriptor = new Math_desc([
          'idDescriptor' => $request->get('idDescriptor'),
          'class' => $request->get('class'),
          //'subject'=> $request->get('subject'),
          'description' => $request->get('description'),
        ]);
        break;
      case 'port':
        $descriptor = new Port_desc([
          'idDescriptor' => $request->get('idDescriptor'),
          'class' => $request->get('class'),
          //'subject'=> $request->get('subject'),
          'description' => $request->get('description'),
        ]);
        break;
      default:
        Session::flash('error', 'Erro - Disciplina não encontrada!');
        return back();
        break;
    }

    if($descriptor->save()){
      Session::flash('success', 'Descritor "'.$descriptor->idDescriptor.'" cadastrado com sucesso!');
      return back();
    }else{
      Session::flash('error', 'Falha ao registrar avaliação!');
      return back();
    }
  }

  public function edit($desc)
  {
    $subjects = Subject::all();
    $grades = Grade::all();

    switch($desc['subject']){
      case 'math':
        $descriptor = Math_desc::find($desc['id']);
        break;
      case 'port':
        $descriptor = Port_desc::find($desc['id']);
        break;
      default:
        Session::flash('error', 'Erro - Disciplina não encontrada!');
        return back();
        break;
    }

    return view('administration.exams.edit', compact('descriptor', 'subjects', 'grades'));
  }

  public function update(Request $request, $desc)
  {
    switch($desc['subject']){
      case 'math':
        $descriptor = Math_desc::find($desc['id']);
        break;
      case 'port':
        $descriptor = Port_desc::find($desc['id']);
        break;
      default:
        Session::flash('error', 'Erro - Disciplina não encontrada!');
        return back();
        break;
    }

    $this->validate($request,[
      'idDescriptor'=>'required',
      'class'=>'required',
      'subject'=>'required',
      'description' => 'required',
    ]);

    $descriptor->idDescriptor = $request->get('idDescriptor');
    $descriptor->class = $request->get('class');
    $descriptor->subject = $request->get('subject');
    $descriptor->description = $request->get('description');

    if($descriptor->save()){
      return redirect('descritor/index')->with('success', 'Alterações salvas com sucesso!');
    }else{
      return redirect('descritor/index')->with('success', 'Falha ao salvar alterações!');
    }
  }

  public function destroy($desc)
  {
    //Define qual tabela o descritor pertence a partir de sua disciplina
    switch($desc['subject']){
      case 'math':
        $descriptor = Math_desc::find($desc['id']);
        break;
      case 'port':
        $descriptor = Port_desc::find($desc['id']);
        break;
      default:
        Session::flash('error', 'Erro - Disciplina não encontrada!');
        return back();
        break;
    }

    if($descriptor->delete()){
      Session::flash('success', 'Descritor "'.$descriptor->idDescriptor.'" removido!');
      return back();
    }else{
      Session::flash('error', 'Erro ao remover descritor "'.$descriptor->idDescriptor.'"');
      return back();
    }
  }
}
