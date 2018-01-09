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

Route::get('/product/view_item/{product}', 'ProductController@Show_product')->name('show_product');
Route::get('/product/{category}', 'ProductController@Show_product_in_cat')->name('products_in_cat');


Route::get('/addToCart/{product}', 'UserController@addToCart')->name('addToCart');
Route::post('/comment' , 'HomeController@comment');

Route::get('/ta','ajaxController@index')->name('test_ajax');
Route::post('/ta','ajaxController@create');



Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
    Route::get('/user-profile', 'UserController@profile')->name('u_user-profile');
    Route::get('/basket', 'UserController@basket')->name('user-basket');

    Route::patch('/UpdateCart/', 'UserController@jquery_post')->name('updateCart');
    Route::post('/update_full_basket/','UserController@update_full_basket')->name('update_full_basket');
    Route::post('request','UserController@Getway_request')->name('Gateway-Request');
    Route::any('callback/from/bank','UserController@Getway_back')->name('Gateway-back');
});

//-----------------------------------------admin panel route-------------------------------------------------------------
Route::group(['prefix'=>'admin','middleware' => ['role:superadministrator|administrator|editor']],function(){
    Route::get('/', 'AdminController@Dashboard')->name('a_Dashboard');
// category
    Route::get('/CreateProductCategory', 'CategoryController@CreateProductCategory')->name('a_CreateProductCategory');
    Route::post('/CreateProductCategory','CategoryController@CreateCategory');
    Route::patch('/CreateProductCategory','CategoryController@EditCategory');
    Route::delete('/CreateProductCategory','CategoryController@DeleteCategory');
// Products
    Route::get('/CreateProducts', 'ProductController@CreateProducts')->name('a_CreateProducts');
    Route::post('/CreateProducts', 'ProductController@Store')->name('a_storeProduct');

    Route::get('/Products', 'ProductController@Products')->name('a_Products');
    Route::delete('/Products', 'ProductController@DeleteProducts')->name('a_Delete_Products');
    Route::get('/product/{product}', 'ProductController@a_Show_product')->name('a_show_product');

    Route::post('/EditProducts', 'ProductController@EditProducts')->name('a_Edit_Products');
    Route::patch('/EditProducts', 'ProductController@EditProducts_Add_image')->name('a_Edit_Products_Image');
    Route::delete('/EditProducts', 'ProductController@EditProducts_Delete_image')->name('a_Edit_Products_delete_Image');
    Route::post('/UpdateProducts', 'ProductController@Update_Products')->name('a_Update_product');
//  Page manager routes
    Route::get('/AddPage','PageController@CreatePage')->name('a_show_create_page');
    Route::post('/AddPage','PageController@StorePage')->name('a_Store_page');
    Route::get('/AddPage/{id}','PageController@ShowPage')->name('a_show_page');
    Route::get('/ShowEditPage','PageController@ShowEditPage')->name('a_show_Edit_page');
    Route::post('/EditPage','PageController@EditPages')->name('a_Edit_page');
    Route::post('/UpdatePage','PageController@UpdatePage')->name('a_Update_page');

    Route::post('/panel/upload-image','ProductController@UploadImage_ckeditor');

//  Access Controller Route
    Route::resource('/users','AclController');
// permission Controller
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);

    Route::resource('comments','CommentController');
    Route::get('disapprove','CommentController@disapprove')->name('a_disapprove_comment');

// jquery post request to page update
    Route::post('/Update','AdminController@jquery_post');

});
//------------------------------admin panel route--------------------------------------//
//-------------------------------------------------------------------------------------//

Route::get('/forbidden',function(){
    return view('Forbidden');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


