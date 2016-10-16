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

Route::group(['middleware' => 'auth'],function(){

    Route::get('inicio', [
        'uses'  =>  'ArticuloController@index',
        'as'    =>  'inicio'
    ]);

    Route::get('extraer', [
        'uses'   => 'ArticuloController@extraer',
        'as'     => 'extraer'
    ]);

    Route::resource('articulo', 'ArticuloController');

    Route::get('scrapprogre', [
        'uses'  =>  'ArticuloController@scrapprogre',
        'as'    =>  'scrapprogre'
    ]);

    Route::get('listarticulos',[
        'uses'  =>  'ArticuloController@listarticulos',
        'as'    =>  'listarticulos'
    ]);

    Route::get('modal/{id}', 'ArticuloController@modal');

    Route::put('modificar/{id}','ArticuloController@modal');

    Route::get('graficar1/{desde}/{hasta}', 'ArticuloController@graficar');

    Route::get('graficar_barra1/{anio}/{mes}','ArticuloController@graficar_barra');

    Route::get('graficar', function(){
      return view('graficar');
    })->name('graficar');

    Route::get('graficar_barra', function(){
      return view('graficar_barra');
    })->name('graficar_barra');


    // Registration routes...
    Route::get('register', [
        'uses'  =>  'Auth\AuthController@getRegister',
        'as'    =>  'register'
    ]);
    
    Route::post('register', [
        'uses'  =>  'Auth\AuthController@postRegister',
        'as'    =>  'register'
    ]);
    
    Route::get('getperfil',[
        'uses'  =>  'UserController@getperfil',
        'as'    =>  'getperfil'
    ]);
    
    Route::post('postperfil',[
        'uses'  =>  'UserController@postperfil',
        'as'    =>  'postperfil'
    ]);
    
});    


// Authentication routes...
Route::get('/', [
    'uses'  =>  'Auth\AuthController@getLogin',
    'as'    =>  'login'
]);

Route::post('login', [
    'uses'  =>  'Auth\AuthController@postLogin',
    'as'    =>  'login'
]);

Route::get('logout', [
    'uses'  =>  'Auth\AuthController@getLogout',
    'as'    =>  'logout'
]);


// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
