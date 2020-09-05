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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
	Route::get('/products', 'Admin\ProductController@index'); //retorna listado de productos
	Route::get('/products/create', 'Admin\ProductController@create'); //retorna formulario registro
	Route::post('/products', 'Admin\ProductController@store'); //registrar producto en DB
	Route::get('/products/{id}/edit', 'Admin\ProductController@edit'); //retorna formulario edición
	Route::post('/products/{id}/edit', 'Admin\ProductController@update'); //actualizar producto de DB
	//Route::post('/admin/products/{id}/delete', 'ProductController@destroy'); //eliminar producto de DB
	Route::delete('/products/{id}', 'Admin\ProductController@destroy'); //eliminar producto de DB

	Route::get('/products/{id}/images', 'Admin\ImageController@index'); //listado imagenes
	Route::post('/products/{id}/images', 'Admin\ImageController@store'); //subir imagenes
	Route::delete('/products/{id}/images', 'Admin\ImageController@destroy'); //eliminar imagenes
	Route::get('/products/{id}/images/select/{image}', 'Admin\ImageController@select'); //destacar imagen
});

