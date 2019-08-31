<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('dashboard.geral.visao_geral');
})->middleware('auth');

Auth::routes([
  'verify' => false,
  'reset' => false
]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/dashboard', function(){
  return view('dashboard.geral.visao_geral');
})->middleware('auth');

//Dashboard
Route::resource('geral', 'Dashboard\Geral\GeralController')->middleware('auth');

//Administracao
Route::resource('administracao', 'Administration\AdminController')->middleware('auth');
Route::resource('avaliacao', 'Administration\ExamController')->middleware('auth');
Route::resource('descritor', 'Administration\DescriptorController')->middleware('auth');
Route::resource('usuario', 'Administration\UserController')->middleware('auth');
