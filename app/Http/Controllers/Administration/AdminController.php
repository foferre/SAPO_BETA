<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gate;
use Session;

use App\User;
use App\Schools;
use App\Type;

class AdminController extends Controller
{
  public function index()
  {
    if(Gate::allows('isAdmin')){
      $schools = Schools::all();
      $types = Type::all();
    }elseif(Gate::allows('isGeneral')){
      $schools = Schools::all();
      $types = Type::where('id', '!=', 1)->get();
    }else{
      $schools = Schools::where('name', '=', Auth::user()->school)->get();
      $types = Type::where('description', '=', Auth::user()->type)->get();
    }
    return view('administration.administration', compact('schools', 'types'));
  }

  public function update(Request $request, $id)
  {
    $user = Auth::user();

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
      Session::flash('success', 'Alterações salvas!');
      return back();
    }else{
      Session::flash('error', 'Falha ao salvar alterações!');
      return back();
    }
  }
}
