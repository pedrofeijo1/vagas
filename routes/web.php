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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'VagasController@search')->name('search');
Route::get('/list', 'VagasController@list')->name('list');

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/proucurarVagas', 'VagasController@proucurarVagas')->name('proucurarVagas');

//Route::get('/sql', 'SqlController@vagas')->name('vagas');


