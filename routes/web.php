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
Route::post('chi-tiet-san-pham/{id}/{slug}', 'Product_reviewController@review');//bình luận
//tìm kiếm
Route::get('search', 'PagesController@search')->name('tim_kiem');

//Đặt hàng - Order
Route::get('add-to-cart/{id}', 'OrderController@getAddToCart');
Route::get('delete-cart/{id}', 'OrderController@getDeleteItemCart');
Route::get('dat-hang', 'OrderController@checkout')->name('checkout');
Route::post('dat-hang', 'OrderController@post_checkout')->name('post_checkout');

Route::group(['prefix' => 'ajax'], function(){
	Route::get('districts/{province_id}', 'AjaxController@getDistrict');
});

//đăng kí và đăng nhập
Route::get('login', 'CustomerController@login')->name('customer_login');
Route::post('login', 'CustomerController@post_login');
Route::get('signup', 'CustomerController@signup')->name('customer_signup');
Route::post('signup', 'CustomerController@post_signup');
//Đăng xuất
Route::get('logout', 'CustomerController@logout')->name('customer_logout');
//Route cho admin
Route::get('admin/login', 'AdminController@login')->name('admin_login');
Route::post('admin/login', 'AdminController@post_login');
Route::get('admin/logout', 'AdminController@logout')->name('admin_logout');
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function(){
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
	//admin/product/index
	Route::group(['prefix' => 'product'], function(){
		Route::get('index', 'ProductController@index')->name('product_index');

		Route::get('create', 'ProductController@create')->name('product_create');
		Route::post('create', 'ProductController@post_create');

		Route::get('update/{id}', 'ProductController@update');
		Route::post('update/{id}', 'ProductController@post_update');

		Route::get('delete/{id}', 'ProductController@delete');
	});
	//admin/product_review/index/{id}
	Route::group(['prefix' => 'product_review'], function(){
		Route::get('index/{id}', 'Product_reviewController@index');

		Route::get('update/{product_id}/{id}', 'Product_reviewController@update');
		Route::post('update/{product_id}/{id}', 'Product_reviewController@post_update');
	});

	//admin/order_new/index
	Route::group(['prefix' => 'order_new'], function(){
		Route::get('index', 'OrderController@indexNew')->name('order_new_index');
		Route::get('delete/{id}', 'OrderController@deleteNew');
	});

	//admin/order_old/index
	Route::group(['prefix' => 'order_old'], function(){
		Route::get('index', 'OrderController@indexOld')->name('order_old_index');
		Route::get('delete/{id}', 'OrderController@deleteOld');

	});

	//admin/order_item/index/{id}
	Route::group(['prefix' => 'order_item'], function(){
		Route::get('index/{order_id}', 'Order_itemController@index')->name('order_item_index');
		Route::post('index/{order_id}', 'OrderController@update');
	});

	//admin/customer/index
	Route::group(['prefix' => 'customer'], function(){
		Route::get('index', 'CustomerController@index')->name('customer_index');
		Route::get('delete/{id}', 'CustomerController@delete');
	});

	//admin/user/index
	Route::group(['prefix' => 'user'], function(){
		Route::get('index', 'AdminController@index')->name('admin_index');
		Route::get('delete/{id}', 'AdminController@delete');

		Route::get('create', 'AdminController@create')->name('admin_create');
		Route::post('create', 'AdminController@post_create');

		Route::get('update/{id}', 'AdminController@update');
		Route::post('update/{id}', 'AdminController@post_update');
	});
});