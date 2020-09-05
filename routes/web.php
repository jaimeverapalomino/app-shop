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


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
	Route::get('/products', 'ProductController@index'); //retorna listado de productos
	Route::get('/products/create', 'ProductController@create'); //retorna formulario registro
	Route::post('/products', 'ProductController@store'); //registrar producto en DB
	Route::get('/products/{id}/edit', 'ProductController@edit'); //retorna formulario edición
	Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar producto de DB

	//Route::post('/admin/products/{id}/delete', 'ProductController@destroy'); //eliminar producto de DB
	Route::delete('/products/{id}', 'ProductController@destroy'); //eliminar producto de DB

	Route::get('/products/{id}/images', 'ImageController@index'); //listado imagenes
	Route::post('/products/{id}/images', 'ImageController@store'); //subir imagenes
	Route::delete('/products/{id}/images', 'ImageController@destroy'); //eliminar imagenes
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar imagen
});

