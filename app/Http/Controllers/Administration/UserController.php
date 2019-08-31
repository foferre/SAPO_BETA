<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

use Session;
use App\User;
use App\Schools;
use App\Type;

class UserController extends Controller
{
  public function index()
  {
    $users = User::select('id', 'name', 'username', 'type', 'school')->get();
    $schools = Schools::all();
    $types = Type::all();
    return view('administration.users.users-edit', compact('users', 'schools', 'types'));
  }

  public function show()
  {
    $users = User::select('id', 'name', 'username', 'type', 'school')->get();
    $schools = Schools::all();
    $types = Type::all();
    return view('administration.users.users-edit', compact('users', 'schools', 'types'));
  }

  public function create()
  {
    $schools = Schools::all();
    $types = Type::all();
    return view('administration.users.users-create', compact('schools', 'types'));
  }

  public function store(Request $request)
  {
    $this->validate($request,[
      'name'=> 'required',
      'username'=> 'required', 'string', 'unique:users',
      'password'=> 'required', 'string', 'confirmed',
      'type' => 'required',
      'school' => 'required',
    ]);

    $user = new User();

    $user->name = 'Teste';
    $user->username = 'Teste';
    $user->password = Hash::make('adkosakd');
    $user->type = 'asdojasjd';
    $user->school = 'asdasd';

    /*$user = User::create([
      'name' => $request->get('name'),
      'username' => $request->get('username'),
      'password' => Hash::make($request->get('name')),
      'type' => $request->get('type'),
      'school' => $request->get('school'),
    ]);*/
    $user->save();
    /*if(true){
      Session::flash('success', 'Usuário "'.$user->username.'" cadastrado com sucesso!');
      return back();
    }else{
      Session::flash('error', 'Falha ao registrar usuário!');
      return back();
    }*/
    return back();
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
