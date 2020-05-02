<?php

use Illuminate\Support\Facades\Route;

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
    return view('principal');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', function(){
    return view('contenido/contenido');
})->name('admin');


Route::get('/rol','RolController@index');
Route::get('/rol/selectrol','RolController@selectRol');
Route::post('/rol/agregar', 'RolController@store');
Route::put('/rol/actualizar', 'RolController@update');
Route::put('/rol/activar', 'RolController@activar');
Route::put('/rol/desactivar', 'RolController@desactivar');


Route::get('/tipo-plato','TipoPlatoController@index');
Route::get('/tipo-plato/selectipo-plato','TipoPlatoController@selectTipo');
Route::post('/tipo-plato/agregar', 'TipoPlatoController@store');
Route::put('/tipo-plato/actualizar', 'TipoPlatoController@update');
Route::put('/tipo-plato/activar', 'TipoPlatoController@activar');
Route::put('/tipo-plato/desactivar', 'TipoPlatoController@desactivar');

Route::get('/entrada','EntradaController@index');
Route::get('/entrada/selectentrada','EntradaController@selectEntrada');
Route::get('/entrada/buscarentrada','EntradaController@buscarEntrada');
Route::post('/entrada/agregar', 'EntradaController@store');
Route::put('/entrada/actualizar', 'EntradaController@update');
Route::put('/entrada/eliminar', 'EntradaController@destroy');
// Route::put('/entrada/desactivar', 'EntradaController@desactivar');
Route::get('/sopa','SopaController@index');
Route::get('/sopa/selectsopa','SopaController@selectSopa');
Route::get('/sopa/buscarsopa','SopaController@buscarSopa');
Route::post('/sopa/agregar', 'SopaController@store');
Route::put('/sopa/actualizar', 'SopaController@update');
Route::put('/sopa/eliminar', 'SopaController@destroy');

Route::get('/bebida','BebidaController@index');
Route::get('/bebida/selectbebida','BebidaController@selectBebida');
Route::post('/bebida/agregar', 'BebidaController@store');
Route::put('/bebida/actualizar', 'BebidaController@update');
Route::put('/bebida/eliminar', 'BebidaController@destroy');


Route::get('/plato','PlatoController@index');
Route::get('/plato/platoservicio','PlatoController@platoServicio');
Route::post('/plato/agregar', 'PlatoController@store');
Route::put('/plato/actualizar', 'PlatoController@update');
Route::put('/plato/eliminar', 'PlatoController@destroy');


Route::get('/pedido', 'PedidoController@index');
Route::get('/pedido/obtenercabecera', 'PedidoController@obtenerCabecera');
Route::get('/pedido/obtenerdetalles', 'PedidoController@obtenerDetalles');
Route::put('/pedido/atender', 'PedidoController@atendido');
Route::put('/pedido/desatender', 'PedidoController@desatendido');
Route::post('/pedido/registrar', 'PedidoController@store');
Route::put('/pedido/eliminar', 'PedidoController@destroy');
Route::get('/pedido/pdf/{id}', 'PedidoController@pdf')->name('pedido_pdf');

Route::get('/contacto', 'Contactocontroller@index');
Route::post('/contacto/registrar', 'Contactocontroller@store');
Route::put('/contacto/atender', 'ContactoController@atenderContacto');
Route::put('/contacto/desatender', 'ContactoController@desatenderContacto');


Route::get('/user', 'UserController@index');
Route::post('/user/agregar', 'UserController@store');
Route::put('/user/actualizar', 'UserController@update');
Route::put('/user/eliminar', 'UserController@destroy');


Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/notificacion/get', 'NotificationController@get');
