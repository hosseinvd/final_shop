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

Route::get('/', 'ProductController@getIndex')->name('products');

Route::get('/ta','ajaxController@index')->name('test_ajax');
Route::post('/ta','ajaxController@create');

Route::get('/addToCart/{product}', 'ProductController@addToCart')->name('addToCart');




Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
    Route::get('/user-profile', 'UserController@profile')->name('u_user-profile');
});

//admin panel route
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/', 'AdminController@Dashboard')->name('a_Dashboard');

    Route::get('/CreateProductCategory', 'CategoryController@CreateProductCategory')->name('a_CreateProductCategory');
    Route::post('/CreateProductCategory','CategoryController@CreateCategory');
    Route::patch('/CreateProductCategory','CategoryController@EditCategory');
    Route::delete('/CreateProductCategory','CategoryController@DeleteCategory');

    Route::get('/CreateProducts', 'ProductController@CreateProducts')->name('a_CreateProducts');
    Route::post('/CreateProducts', 'ProductController@Store')->name('a_storeProduct');

    Route::get('/Products', 'ProductController@Products')->name('a_Products');
    Route::delete('/Products', 'ProductController@DeleteProducts')->name('a_Delete_Products');

    Route::post('/EditProducts', 'ProductController@EditProducts')->name('a_Edit_Products');
    Route::post('/EditProducts_image', 'ProductController@EditProducts_Add_image')->name('a_Edit_Products_Image');

    Route::post('/panel/upload-image','ProductController@UploadImage_ckeditor');
});


Route::get('/basket', 'UserController@basket')->name('user-basket');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


