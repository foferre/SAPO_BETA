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
Route::get('/dashboard/escolas/{id}/descritores', 'Dashboard\Escolas\SchoolController@descQuery')->middleware('auth');
Route::post('/dashboard/escolas/descritores', 'Dashboard\Escolas\SchoolController@descShow')->middleware('auth');

//>>Turmas
//>>>>Resultado geral
Route::get('/dashboard/turmas/resultado_geral', 'Dashboard\Turmas\ClassController@resGeral')->middleware('auth');
Route::get('/dashboard/turmas/{id}/buscar_escola', 'Dashboard\Turmas\ClassController@schoolQuery')->middleware('auth');
Route::post('/dashboard/turmas/buscar_escola', 'Dashboard\Turmas\ClassController@resShow')->middleware('auth');
//>>>>Descritores
Route::get('/dashboard/turmas/descritor_geral', 'Dashboard\Turmas\ClassController@descGeral')->middleware('auth');
Route::get('/dashboard/turmas/{id}/descritores', 'Dashboard\Turmas\ClassController@descQuery')->middleware('auth');
Route::post('/dashboard/turmas/descritores', 'Dashboard\Turmas\ClassController@descShow')->middleware('auth');

//>>Alunos
//>>>>Boletim
Route::get('/dashboard/alunos/avaliacoes', 'Dashboard\Alunos\StudentController@resGeral')->middleware('auth');
Route::get('/dashboard/alunos/{id}/buscar_aluno', 'Dashboard\Alunos\StudentController@studentQuery')->middleware('auth');
Route::post('/dashboard/alunos/buscar_aluno', 'Dashboard\Alunos\StudentController@studentShow')->middleware('auth');
Route::get('/dashboard/alunos/{id}/{subject}/{class}/{idExam}/buscar_aluno', 'Dashboard\Alunos\StudentController@showTemplate')->middleware('auth');

//Administracao
Route::resource('administracao', 'Administration\AdminController')->middleware('auth');
Route::resource('avaliacao', 'Administration\ExamController')->middleware('auth');
Route::resource('descritor', 'Administration\DescriptorController')->middleware('auth');
Route::resource('usuario', 'Administration\UserController')->middleware('auth');
