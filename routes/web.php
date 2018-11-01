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

Route::get('/uploadfileget', function(){return view('uploadfile');});
Route::resource('uploadfile', 'UploadFileController');

Route::prefix('admin')->middleware('auth')->group(function(){
    //pelanggan
    Route::resource('pelanggan', 'Pelanggan\PelangganController');

    //barang
    Route::get('barang/loadBarang', 'Barang\BarangController@loadBarang');
    Route::resource('barang', 'Barang\BarangController');
});

//dari pak abdul rahim
// Route::prefix('admin')->middleware('auth')->group(function(){
//      Route::get('','PelangganController@index')->name('pelanggan_index');
//      Route::get('pelanggan','PelangganController@index')->name('pelanggan_index');
//      Route::get('pelanggan/tambah','PelangganController@create');
//      Route::post('store','PelangganController@store');
//
//      //data barang
//      Route::get('barang', 'BarangController@index')->name('barang_index');
//      Route::get('barang/tambah', 'BarangController@create')->name('tambah_barang');
//      Route::post('barang/store', 'BarangController@store')->name('store_barang');
//  });

Route::get('/login', function(){
	return "ini halaman login";
});

Route::get('/beranda', "BerandaController@fungsi1");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
