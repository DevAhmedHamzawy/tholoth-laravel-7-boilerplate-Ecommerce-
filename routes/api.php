<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => ['auth:api']],function(){

    Route::post('add_to_cart', 'CartController@store');
    Route::get('show_cart', 'CartController@show');
    Route::post('update_cart', 'CartController@update');
    Route::post('delete_cart', 'CartController@delete');

    Route::post('check_out', 'CartController@checkOut');
    Route::post('summary', 'CartController@summary');
    Route::post('shipping_address', 'ShippingAddressController@store');

 

    Route::post('update_user', 'UserController@update');


    Route::post('save_order', 'OrderController@store');

    Route::post('save_favourite', 'FavouriteController@store');


});

Route::post('search', 'SearchController@index');


// List Categories And Sub Categories
Route::get('the_categories', 'CategoryController@index')->name('get_categories');
Route::get('the_sub_categories/{id}', 'TheSubCategoryController@index')->name('get_subcategories');

// List The Product & Show the Product
Route::get('the_products', 'ProductController@index')->name('get_products');
Route::get('the_products/{id?}', 'ProductController@show')->name('get_the_product');

// Show The Settings
Route::get('the_settings', 'SettingsController@index')->name('get_settings');

// Show The All Pages
Route::get('the_pages', 'PageController@index')->name('get_pages');

// Show Sliders
Route::get('main_sliders', 'SliderController@main')->name('get_main_sliders');
Route::get('the_sliders/{id?}', 'SliderController@byCategory')->name('get_sliders_by_category');

// Show Brands ("Vendors")
Route::get('brands', 'VendorController@index')->name('get_brands');

// Most Selling Products
Route::get('most_selling_products', 'ProductController@mostSold');

// Product Offers
Route::get('product_offers', 'ProductController@productOffers');