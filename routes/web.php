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
use App\Vendor;
use App\Goods;


Route::post('/vendor/add', 'VendorController@create')->name('vendorCreate');

Route::delete('/vendor/{vendor_id}', function($id) {
		Vendor::findOrFail($id)->delete();
		return response()->json(null, 204);
	})->name('vendorDelete');

Route::post('/goods/add', 'GoodsController@create')->name('goodsCreate');

Route::delete('/goods/{item_id}', function($id) {
		Goods::findOrFail($id)->delete();
		return response()->json(null, 204);
	})->name('goodsDelete');

Route::get('/', 'MainController@index');
//Route::get('/', 'GoodsController@index');