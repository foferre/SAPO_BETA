<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Descriptors;
use App\Grade;
use App\Subject;

class DescriptorController extends Controller
{
  public function index() //descriptors-edit
  {
    $descriptors = Descriptors::all();
    $subjects = Subject::all();
    return view('administration.descriptors.descriptors-edit', compact('descriptors', 'subjects'));
  }

  public function show() //descriptors-edit
  {
    $descriptors = Descriptors::all();
    $subjects = Subject::all();
    return view('administration.descriptors.descriptors-edit', compact('descriptors', 'subjects'));
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

    $descriptor = new Descriptors([
      'idDescriptor' => $request->get('idDescriptor'),
      'class' => $request->get('class'),
      'subject'=> $request->get('subject'),
      'description' => $request->get('description'),
    ]);

    if($descriptor->save()){
      Session::flash('success', 'Descritor "'.$descriptor->idDescriptor.'" cadastrado com sucesso!');
      return back();
    }else{
      Session::flash('error', 'Falha ao registrar avaliação!');
      return back();
    }
  }

  public function edit($id)
  {
    $subjects = Subject::all();
    $grades = Grade::all();
    $descriptor = Descriptors::find($id);

    return view('administration.descriptors.edit', compact('descriptor', 'subjects', 'grades'));
  }

  public function update(Request $request, $id)
  {
    $descriptor = Descriptors::find($id);

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

  public function destroy($id)
  {
    $descriptor = Descriptors::find($id);

    if($descriptor->delete()){
      Session::flash('success', 'Descritor "'.$descriptor->idDescriptor.'" removido!');
      return back();
    }else{
      Session::flash('error', 'Erro ao remover descritor "'.$descriptor->idDescriptor.'"');
      return back();
    }
  }
}
