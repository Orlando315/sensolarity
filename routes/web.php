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

/* --- Dispositivos data --- */
Route::get('dispositivos/data/store', 'DispositivosUsersDataController@store')->name('dispositivos.data.store');

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
  Route::prefix('/dispositivos')->name('dispositivos.')->group(function(){
    Route::patch('{dispositivo}/status', 'DispositivosUsersController@status')->name('status');
    Route::post('checkIfExist', 'DispositivosUsersController@checkIfExist')->name('checkIfExist');

    Route::get('modulo/all', 'DispositivosUsersController@modulos')->name('modulos.index');
    Route::get('mapa/all', 'DispositivosUsersController@mapaIndex')->name('mapa.index');

    /* --- Dispositivos Data --- */
    Route::get('{dispositivo}/data/{data}/history', 'DispositivosUsersDataController@history')->name('data.history');
    Route::post('{dispositivo}/data/{data}/get', 'DispositivosUsersDataController@get')->name('data.get');

    /* --- Dispositivos Configuracion --- */
    Route::get('{dispositivo}/m/{data}/config', 'DispositivosUsersConfigController@config')->name('data.config');
    Route::patch('{dispositivo}/m/{data}/config', 'DispositivosUsersConfigController@updateM')->name('config.updateM');

    Route::get('{dispositivo}/mapa', 'DispositivosUsersController@mapaShow')->name('mapa.show');
    Route::patch('{dispositivo}/p/{data}/config', 'DispositivosUsersConfigController@updateP')->name('config.updateP');
    Route::post('{dispositivo}/get/{data}/config', 'DispositivosUsersConfigController@get');

    // Guardar ubicacion del dispositivo
    Route::patch('{dispositivo}/mapa/location', 'DispositivosUsersConfigController@location')->name('config.location');
  });

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
