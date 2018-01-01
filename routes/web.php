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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('foo', function () {
    return 'Hello World';
});
Route::resource('user', 'UserController');
Route::get('/crud', 'CrudController@index');
Route::resource('pembelian', 'PembelianController');
Route::resource('barang', 'BarangController');
Route::resource('tagihan', 'TagihanController');
Route::get('charts','chartController@index');