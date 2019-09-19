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
Route::get('/dashboard/geral/descritor_geral', 'Dashboard\Geral\GeralController@descGeral')->middleware('auth');
Route::get('/dashboard/geral/{id}/descritores', 'Dashboard\Geral\GeralController@descShow')->middleware('auth');
//>>Escolas
//>>>>Resultado geral
Route::get('/dashboard/escolas/resultado_geral', 'Dashboard\Escolas\SchoolController@resGeral')->middleware('auth');
Route::get('/dashboard/escolas/{id}/buscar_escola', 'Dashboard\Escolas\SchoolController@schoolQuery')->middleware('auth');
Route::post('/dashboard/escolas/buscar_escola', 'Dashboard\Escolas\SchoolController@resShow')->middleware('auth');
//>>>>Descritores
Route::get('/dashboard/escolas/descritor_geral', 'Dashboard\Escolas\SchoolController@descGeral')->middleware('auth');
Route::get('/dashboard/escolas/{id}/visualizar', 'Dashboard\Escolas\SchoolController@resShow')->middleware('auth');
/*>>>>Turmas
Route::get('/dashboard/escolas/turmas_geral', 'Dashboard\Escolas\SchoolController@descGeral')->middleware('auth');
Route::post('/dashboard/escolas/{id}/turmas', 'Dashboard\Escolas\SchoolController@descShow')->middleware('auth');*/

//Administracao
Route::resource('administracao', 'Administration\AdminController')->middleware('auth');
Route::resource('avaliacao', 'Administration\ExamController')->middleware('auth');
Route::resource('descritor', 'Administration\DescriptorController')->middleware('auth');
Route::resource('usuario', 'Administration\UserController')->middleware('auth');
