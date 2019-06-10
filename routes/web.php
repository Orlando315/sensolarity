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

Route::view('/', 'auth.login');
Route::view('login', 'auth.login');

Auth::routes();

/* --- Solo usuarios autenticados --- */
Route::group(['middleware' => 'auth'], function () {
  /* --- Dashboard --- */
  Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

  /* --- Perfil --- */
  Route::get('perfil', 'HomeController@perfil')->name('perfil');
  Route::patch('perfil', 'HomeController@updatePerfil')->name('perfil.update');
  Route::patch('perfil/password', 'HomeController@password')->name('perfil.password');

  /* --- Dispositivos --- */
  Route::resource('dispositivos', 'DispositivosUsersController');
  Route::patch('dispositivos/{dispositivo}/status', 'DispositivosUsersController@status')->name('dispositivos.status');
  Route::post('dispositivos/check', 'DispositivosUsersController@check')->name('dispositivos.check');

  Route::get('dispositivos/modulo/all', 'DispositivosUsersController@modulo')->name('dispositivos.modulo');
  Route::get('dispositivos/mapa/all', 'DispositivosUsersController@mapa')->name('dispositivos.mapa');

  /* --- Admin --- */
  Route::prefix('/admin')->name('admin.')->namespace('Admin')->middleware('role:admin')->group(function(){        
    /* --- Users --- */
    Route::resource('users', 'UsersControllers');
    Route::patch('users/{user}/password', 'UsersControllers@password')->name('users.password');

    /* --- Configuration --- */
    Route::get('configuration', 'ConfigurationsControllers@index')->name('configurations');
    Route::patch('configuration/update', 'ConfigurationsControllers@update')->name('configurations.update');

    /* --- Dispositivos --- */
    Route::resource('dispositivos', 'DispositivosController');
    Route::patch('dispositivos/{dispositivo}/disponibilidad', 'DispositivosController@disponibilidad')->name('dispositivos.disponibilidad');

  });
});
