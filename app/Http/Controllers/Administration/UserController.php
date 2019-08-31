<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use Gate;

use App\User;
use App\Schools;
use App\Type;
use App\Descriptors;

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

  public function edit($id)
  {
    $user = User::find($id);
    if(Gate::allows('isAdmin')){
      $schools = Schools::all();
      $types = Type::all();
    }elseif(Gate::allows('isGeneral')){
      $schools = Schools::all();
      $types = Type::where('id', '!=', '1');
    }else{
      $schools = Schools::where('id', '=', $user->school)->get();
      $types = Type::where('name', '=', $user->type)->get();
    }

    return view('administration.users.edit', compact('user', 'schools', 'types'));
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);

    if(request('password') == '' && $user->username == request('username'))
    {
      $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'school' => ['required', 'string', 'max:255'],
        'type' => ['required', 'string', 'max:255'],
        'avatar' => ['image', 'mimes:jpeg,png,jpg'],
      ]);
    }elseif(request('password') == '')
    {
      $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'school' => ['required', 'string', 'max:255'],
        'type' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'min:4','max:255', 'unique:users'],
        'avatar' => ['image', 'mimes:jpeg,png,jpg'],
      ]);
    }elseif($user->username == request('username'))
    {
      $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'school' => ['required', 'string', 'max:255'],
        'type' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'min:4','max:255'],
        'password' => ['string', 'min:4', 'confirmed'],
        'avatar' => ['image', 'mimes:jpeg,png,jpg'],
      ]);
      $user->password = Hash::make(request('password'));
    }else{
      $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'school' => ['required', 'string', 'max:255'],
        'type' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'min:4','max:255', 'unique:users'],
        'password' => ['string', 'min:4', 'confirmed'],
        'avatar' => ['image', 'mimes:jpeg,png,jpg'],
      ]);
      $user->password = Hash::make(request('password'));
    }

    $user->name = request('name');
    $user->school = request('school');
    $user->type = request('type');
    $user->username = request('username');

    if(isset($request['avatar'])) {
      $user->addMediaFromRequest('avatar')->toMediaCollection('picture');
    }

    if($user->save()){
      return redirect()->back()->with('alert','Alterações salvas!');
    }else{
      return redirect()->back()->with('alert','Erro ao salvar alterações');
    }
  }

  public function destroy($id)
  {
    $user = User::find($id);

    if($user->delete()){
      Session::flash('success', 'Usuário "'.$user->username.'" excluído!');
      return back();
    }else{
      Session::flash('error', 'Erro ao excluir o usuário "'.$user->username.'"');
      return back();
    }
  }
}
