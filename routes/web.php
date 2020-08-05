<?php
//Auth::routes();

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('login', 'Auth\LoginController@login')->name('login.post');


Route::get('inicio', 'HomeController@index')->name('home');

Route::get('calcular_bono', 'BonoAlemanController@index')->name('index.bonos');
Route::get('list', 'BonoAlemanController@FlujoDePagos')->name('list.plan.pagos');
Route::get('datos_salida', 'BonoAlemanController@DatosDeSalida')->name('datos.salida');
Route::post('consultar_bono', 'BonoAlemanController@calcular')->name('consultar.bono');

Route::get('register','Auth\RegisterController@index')->name('register');
Route::post('register2','BonoAlemanController@createUser')->name('register.post');


