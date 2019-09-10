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

Route::get('/', 'Dashboard\Geral\GeralController@resGeral')->middleware('auth');

Auth::routes([
  'verify' => false,
  'reset' => false
]);

Route::get('/home', 'Dashboard\Geral\GeralController@resGeral')->name('home')->middleware('auth');
Route::get('/dashboard', 'Dashboard\Geral\GeralController@resGeral')->middleware('auth');

//Dashboard
//>>Visão geral
//>>>>Resultado geral
Route::get('/dashboard/geral/resultado_geral', 'Dashboard\Geral\GeralController@resGeral')->middleware('auth');
Route::get('/dashboard/geral/{id}/visualizar', 'Dashboard\Geral\GeralController@resShow')->middleware('auth');
//>>>>Descritores
Route::get('/dashboard/descritores/resultado_geral', 'Dashboard\Geral\GeralController@descGeral')->middleware('auth');
Route::get('/dashboard/descritores/{id}/visualizar', 'Dashboard\Geral\GeralController@descShow')->middleware('auth');

//Administracao
Route::resource('administracao', 'Administration\AdminController')->middleware('auth');
Route::resource('avaliacao', 'Administration\ExamController')->middleware('auth');
Route::resource('descritor', 'Administration\DescriptorController')->middleware('auth');
Route::resource('usuario', 'Administration\UserController')->middleware('auth');
