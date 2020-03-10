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




Route::get('/cashier/login','Cashier\CashierAuth@LoginForm');
Route::post('/cashier/login','Cashier\CashierAuth@Login');
Route::get('/cashier/dashboard','Cashier\Dashboard@Dashboard');
Route::get('/cashier/branch','Cashier\BranchController@view');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
