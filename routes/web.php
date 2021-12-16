<?php

use Illuminate\Support\Facades\Route;

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




Route::get('/', function () { return view('welcome'); });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/invoice/{order}', 'HomeController@invoice')->name('invoice');


// DON'T Put it inside the '/admin' Prefix , Otherwise you'll never get the page due to assign.guard that will redirect you too many times
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


Route::get('list_subcategories/{id}', 'SubCategoryController@list')->name('list_subcategories');

Route::get('list_options/{id}', 'OptionController@list')->name('list_options');



Auth::routes();



Route::group(['middleware' => ['assign.guard:admin,admin/login', 'role:0'] , 'prefix' => 'admin'],function(){

    Route::get('dashboard', 'Admin\DashboardController@index');

    Route::resource('categories', 'Admin\CategoryController');
    Route::get('categories/{category}/delete', 'Admin\CategoryController@destroy')->name('categories.delete');

    Route::resource('categories/{category}/subcategories', 'Admin\SubcategoryController');
    Route::get('categories/{category}/subcategories/{subcategory}/delete', 'Admin\SubcategoryController@destroy')->name('subcategories.delete');

    Route::resource('products', 'Admin\ProductController');
    Route::get('products/special/{product}' , 'Admin\ProductController@special')->name('products.special');
    Route::get('products/{product}/delete', 'Admin\ProductController@destroy')->name('products.delete');

    Route::resource('options', 'Admin\OptionController');
    Route::get('options/{option}/delete', 'Admin\OptionController@destroy')->name('options.delete');

    // Settings
    Route::get('settings', 'Admin\SettingsController@edit')->name('settings.edit');
    Route::patch('settings/update', 'Admin\SettingsController@update')->name('settings.update');


    // Users
    Route::resource('users', 'Admin\UserController');
    Route::get('users/{user}/delete', 'Admin\UserController@destroy')->name('users.delete');

    // Admins
    Route::resource('admins', 'Admin\AdminController');
    Route::get('admins/{admins}/delete', 'Admin\AdminController@destroy')->name('admins.delete');


    Route::resource('sliders', 'Admin\SliderController');
    Route::get('the_sliders/{category}', 'Admin\SliderController@index')->name('the_sliders.index');
    Route::get('the_sliders/main/{slider}', 'Admin\SliderController@main')->name('the_sliders.main');
    Route::get('sliders/{slider}', 'Admin\SliderController@destroy')->name('sliders.delete');

    
    // vendor products
    Route::resource('vendor_products/{vendor}/the_vendor_products', 'Admin\VendorProductController');
    Route::get('vendor_products/{vendor}/the_vendor_products/{the_vendor_product}/delete', 'Admin\VendorProductController@destroy')->name('the_vendor_products.delete');

  
    Route::resource('vendor_sliders/{vendor}/the_vendor_sliders', 'Admin\VendorSliderController');
    Route::get('vendor_sliders/{vendor}/the_vendor_sliders/{the_vendor_slider}/delete', 'Admin\VendorSliderController@destroy')->name('the_vendor_sliders.delete');


    Route::resource('pages', 'Admin\PageController');
    Route::get('pages/{page}/delete', 'Admin\PageController@destroy')->name('pages.delete');

    Route::resource('the_vendors', 'Admin\VendorController')->only('index');

    Route::resource('orders', 'Admin\OrderController');
    Route::resource('returnings', 'Admin\ReturningsController');

});



Route::group(['middleware' => ['assign.guard:admin,admin/login', 'role:1'], 'prefix' => 'vendor'],function(){

   Route::get('v_dashboard', 'Vendor\DashboardController@index')->name('v_dashboard');

    Route::resource('v_sliders', 'Vendor\SliderController')->only(['index','store']);
    Route::get('v_sliders/{slider}', 'Vendor\SliderController@destroy')->name('v_sliders.delete');

    Route::resource('v_products', 'Vendor\ProductController');
    Route::get('v_products/{v_product}/delete', 'Vendor\ProductController@destroy')->name('v_products.delete');

    // Settings
    Route::get('v_settings/{vendor}', 'Vendor\SettingsController@edit')->name('v_settings.edit');
    Route::patch('v_settings/{vendor}/update', 'Vendor\SettingsController@update')->name('v_settings.update');

    Route::resource('v_orders', 'Vendor\OrderController');
    Route::resource('v_returnings', 'Vendor\ReturningsController');


});