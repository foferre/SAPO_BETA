<?php

namespace App\Http\Controllers\Dashboard\Geral;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

use App\Exams;

class GeralController extends Controller
{
  public function index()
  {
    if(Gate::allows('isAdmin')) //Se for ADM, busca todos os resultados
    {
      $exams = Exams::all();
    }else{ //Senão, busca apenas os resultados de escopo GERAL (escola id 0, geral) ou da escola do usuário
      $exams = Exams::where('scope','=','0')->orWhere('scope','=',Auth()->user()->school)->get();
    }
    return view('dashboard.geral.visao_geral', compact('exams'));
  }
}
