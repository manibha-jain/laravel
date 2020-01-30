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


Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', 'HomeController@open_homepage')->name('homepage');
Route::get('/product-detail/{pro_id}', 'HomeController@product_detail')->name('product_detail');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/widgets-dash', 'HomeController@open_widgets')->name('widgets');
Route::get('/catg-form', 'HomeController@category_form')->name('category');
Route::get('/products-form', 'HomeController@products_form')->name('products');
Route::get('/variants-form/{id}', 'HomeController@variants_form')->name('variant');
Route::get('/subcat-form/{id}', 'HomeController@subcat_form');
Route::get('/products', 'HomeController@product_list')->name('product_list');
Route::get('/variants/{id}', 'HomeController@variant_list')->name('variant_list');
Route::get('/subcategory/{id}', 'HomeController@subcategory_list')->name('subcategory_list');
Route::post('/create-category', 'HomeController@save_category')->name('create_category');
Route::post('/create-product', 'HomeController@save_product')->name('create_product');
Route::post('/create-variant', 'HomeController@save_variant')->name('create_variant');
Route::post('/create-subcategory', 'HomeController@save_subcategory')->name('create_subcategory');
Route::get('/offers-form', 'HomeController@offers_form')->name('offers');
Route::post('/create-offers', 'HomeController@save_offer')->name('create_offer');
Route::get('/logout', 'HomeController@logout_user')->name('logout');
Route::get('protected', ['middleware' => ['auth', 'admin'], function() {

}]);

