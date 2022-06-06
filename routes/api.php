<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function(){
        Route::delete('/pelanggan/{id_pelanggan}', 'PelangganController@destroy');
        Route::delete('/produk/{id_produk}', 'ProdukController@destroy');
        Route::delete('/transaksi/{id_transaksi}', 'TransaksiController@destroy');
        Route::delete('/detail_transaksi/{id_detail_transaksi}', 'Detail_TransaksiController@destroy');
    });
    
    Route::group(['middleware' => ['api.admin']], function(){
        Route::post('/pelanggan', 'PelangganController@store');
        Route::put('/pelanggan/{id_pelanggan}', 'PelangganController@update');

        Route::post('/produk', 'ProdukController@store');
        Route::put('/produk/{id_produk}', 'ProdukController@update');

        Route::post('/transaksi', 'TransaksiController@store');
        // Route::post('/storecarttodb', 'TransaksiController@store');
        Route::put('/transaksi/{id_transaksi}', 'TransaksiController@update');

        Route::post('/detail_transaksi', 'Detail_TransaksiController@store');
        Route::put('/detail_transaksi/{id_detail_transaksi}', 'Detail_TransaksiController@update');

        Route::post('/storecarttodb', 'transactionController@store');
    });
    Route::get('/pelanggan', 'PelangganController@show');
    Route::get('/pelanggan/{id_pelanggan}', 'PelangganController@detail');
    //Route::post('/pelanggan', 'PelangganController@store');
    //Route::put('/pelanggan/{id_pelanggan}', 'PelangganController@update');
    //Route::delete('/pelanggan/{id_pelanggan}', 'PelangganController@destroy');

    Route::get('/produk', 'ProdukController@show');
    Route::get('/produk/{id_produk}', 'ProdukController@detail');
    //Route::post('/produk', 'ProdukController@store');
    //Route::put('/produk/{id_produk}', 'ProdukController@update');
    //Route::delete('/produk/{id_produk}', 'ProdukController@destroy');

    Route::get('/transaksi', 'TransaksiController@show');
    Route::get('/transaksi/{id_transaksi}', 'TransaksiController@detail');
    //Route::post('/transaksi', 'TransaksiController@store');
    //Route::put('/transaksi/{id_transaksi}', 'TransaksiController@update');
    //Route::delete('/transaksi/{id_transaksi}', 'TransaksiController@destroy');

    Route::get('/detail_transaksi', 'Detail_TransaksiController@show');
    Route::get('/detail_transaksi/{id_detail_transaksi}', 'Detail_TransaksiController@detail');
    //Route::post('/detail_transaksi', 'Detail_TransaksiController@store');
    //Route::put('/detail_transaksi/{id_detail_transaksi}', 'Detail_TransaksiController@update');
    //Route::delete('/detail_transaksi/{id_detail_transaksi}', 'Detail_TransaksiController@destroy');
});
