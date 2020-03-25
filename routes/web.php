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
//superadmin section
Route::get('/notadmin/login','SuperAdmin\SuperAdminAuth@LoginForm');
Route::post('/notadmin/login','SuperAdmin\SuperAdminAuth@Login');
Route::get('/notadmin/dashboard','SuperAdmin\Dashboard@Dashboard');


//superadmin cashier management
Route::get('/notadmin/cashier/add','SuperAdmin\CashierController@addform');
Route::post('/notadmin/cashier/add','SuperAdmin\CashierController@add');
Route::get('/notadmin/cashiers','SuperAdmin\CashierController@list');
Route::get('/notadmin/cashier/delete/{id}','SuperAdmin\CashierController@delete');
Route::get('/notadmin/cashier/edit/{id}','SuperAdmin\CashierController@edit');
Route::post('/notadmin/cashier/update','SuperAdmin\CashierController@update');


//superadmin branch management
Route::get('/notadmin/branch/add','SuperAdmin\BranchController@addform');
Route::post('/notadmin/branch/add','SuperAdmin\BranchController@add');
Route::get('/notadmin/branches','SuperAdmin\BranchController@list');
Route::get('/notadmin/branch/delete/{id}','SuperAdmin\BranchController@delete');
Route::get('/notadmin/branch/edit/{id}','SuperAdmin\BranchController@edit');
Route::post('/notadmin/branch/update','SuperAdmin\BranchController@update');

Route::get('/notadmin/branch/availablity-switch/{id}','SuperAdmin\BranchController@AvailablitySwitch');


//superadmin product management
//Route::get('/notadmin/product/add','SuperAdmin\BranchController@addform');
//Route::post('/notadmin/product/add','SuperAdmin\BranchController@add');
Route::get('/notadmin/products','SuperAdmin\ProductController@list');
//Route::get('/notadmin/product/delete/{id}','SuperAdmin\ProductController@delete');
//Route::get('/notadmin/product/edit/{id}','SuperAdmin\ProductController@edit');
//Route::post('/notadmin/product/update','SuperAdmin\ProductController@update');

Route::get('/notadmin/product/availablity-switch/{id}','SuperAdmin\ProductController@AvailablitySwitch');
Route::get('/notadmin/product/approval-switch/{id}','SuperAdmin\ProductController@ApprovalSwitch');

//superadmin category management
Route::get('/notadmin/category/add','SuperAdmin\CategoryController@addform');
Route::post('/notadmin/category/add','SuperAdmin\CategoryController@add');
Route::get('/notadmin/categories','SuperAdmin\CategoryController@list');
Route::get('/notadmin/category/delete/{id}','SuperAdmin\CategoryController@delete');
Route::get('/notadmin/category/edit/{id}','SuperAdmin\CategoryController@edit');
Route::post('/notadmin/category/update','SuperAdmin\CategoryController@update');

//cashier product management
Route::get('/cashier/product/add','Cashier\ProductController@addform');
Route::post('/cashier/product/add','Cashier\ProductController@add');
Route::get('/cashier/products','Cashier\ProductController@list');
Route::get('/cashier/product/delete/{id}','Cashier\ProductController@delete');
Route::get('/cashier/product/edit/{id}','Cashier\ProductController@edit');
Route::post('/cashier/product/update','Cashier\ProductController@update');

Route::get('/cashier/product/availablity-switch/{id}','Cashier\ProductController@AvailablitySwitch');

Route::get('/cashier/login','Cashier\CashierAuth@LoginForm');
Route::post('/cashier/login','Cashier\CashierAuth@Login');
Route::get('/cashier/dashboard','Cashier\Dashboard@Dashboard');
Route::get('/cashier/branch','Cashier\BranchController@view');


Route::get('/','Common\BranchController@list');
Route::get('/online-food-menu','Common\FoodMenuController@list');
Route::get('/getProdOpts/{id}','Common\FoodMenuController@getProdOpts');
Route::post('/CityAreaSelection','Common\CityAreaController@submit');
Route::get('/getAreas/{cityname}','Common\CityAreaController@getAreas');

Route::get('/branch/{branchslug}','Common\BranchController@branchSelection');

Route::post('/add-to-cart','Common\CartController@add');

Route::get('/OptionQuantity/{cart_item_id}/{quantity}','Common\CartController@quantity');
Route::get('/removeCart/{cart_item_id}','Common\CartController@removeItem');
Route::get('/OnPageLoad','Common\CartController@OnPageLoad');

Route::get('/checkout','Common\CheckoutController@addresses')->middleware('auth');
Route::get('/guest-checkout','Common\CheckoutController@addresses');

Route::post('/address/add','Common\CheckoutController@addAddress');
Route::get('/select-address/{id}','Common\CheckoutController@SelectAddress');

Route::post('/PaymentOptionSelection','Common\CcavenueController@payment');
Auth::routes();



//Route::get('/home', 'HomeController@index')->name('home');
