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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','PagesController@index');

//Route cho giao diện người dùng
Route::get('trang-chu', 'PagesController@index')->name('index');
Route::get('loai-san-pham/{id}', 'PagesController@loai_sanpham');
Route::get('thuong-hieu-san-pham/{id}', 'PagesController@thuonghieu_sanpham');
Route::get('gioi-thieu', 'PagesController@about')->name('about');
Route::get('lien-he', 'PagesController@contacts')->name('contacts');
Route::get('chi-tiet-san-pham/{id}/{slug}', 'PagesController@getProduct');

//Route cho admin
/*Route::get('thu', function(){
	return view('admin.product.index');
});*/

Route::group(['prefix' => 'admin'], function(){
	//Product_category
	//admin/product-category/index
	Route::group(['prefix' => 'product-category'], function(){
		Route::get('index', 'Product_categoryController@index')->name('product_category_index');

		Route::get('create', 'Product_categoryController@create')->name('product_category_create');
		Route::post('create', 'Product_categoryController@post_create');

		Route::get('update/{id}', 'Product_categoryController@update');
		Route::post('update/{id}', 'Product_categoryController@post_update');

		Route::get('delete/{id}', 'Product_categoryController@delete');
	});
	//admin/brand/index
	Route::group(['prefix' => 'brand'], function(){
		Route::get('index', 'BrandController@index')->name('brand_index');

		Route::get('create', 'BrandController@create')->name('brand_create');
		Route::post('create', 'BrandController@post_create');

		Route::get('update/{id}', 'BrandController@update');
		Route::post('update/{id}', 'BrandController@post_update');

		Route::get('delete/{id}', 'BrandController@delete');
	});
});