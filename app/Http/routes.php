<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
  return view('inicio');
})->name('inicio');

//
Route::get('extraer', function(){
  return view('extraer');
})->name('extraer');

Route::resource('articulo', 'ArticuloController');
Route::get('scrapprogre', 'ArticuloController@scrapprogre')->name('scrapprogre');
Route::get('listarticulos','ArticuloController@listarticulos')->name('listarticulos');
Route::get('modal/{id}', 'ArticuloController@modal')->name('modal');
Route::put('modificar/{id}','ArticuloController@modal')->name('modificar');

Route::get('graficar1/{desde}/{hasta}','ArticuloController@graficar')->name('graficar');

Route::get('graficar', function(){
  return view('graficar');
})->name('graficar');
