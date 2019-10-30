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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/companyinfo','HomeController@company')->name('companyinfo');
Route::post('/addcompanyinfo','HomeController@addcompanyinfo')->name('addcompanyinfo');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products','ProductController@products')->name('products');
Route::post('/add-product','ProductController@add_product')->name('add_product');
Route::get('/delete-product/{id}','ProductController@delete_product')->name('delete_product');
Route::get('/users','UserController@users')->name('users');
Route::post('/addUser','UserController@addUser')->name('addUser');
Route::get('/delUser/{id}','UserController@delUser')->name('delUser');
Route::get('/editUser/{id}','UserController@editUser')->name('editUser');
Route::post('/updateUser','UserController@updateUser')->name('updateUser');
Route::get('/inventory','ProductController@inventory')->name('inventory');
Route::post('/addInventory','ProductController@addInventory')->name('addInventory');
Route::get('/getProPrice/{id}','ProductController@getProPrice')->name('getProPrice');
Route::post('/updatePrice','ProductController@updatePrice')->name('updatePrice');
Route::get('/sales','ProductController@sales')->name('sales');
Route::post('/addDailySales','ProductController@addDailySales')->name('addDailySales');
Route::get('/report','ReportController@report')->name('report');
Route::post('/report','ReportController@getreport')->name('report');
Route::get('/delrecord/{id}','ProductController@delrecord')->name('delrecord');
Route::get('/viewrecord/{id}','ProductController@viewrecord')->name('viewrecord');
Route::get('/printreport', 'ReportController@printreport')->name('printreport');
Route::post('/printreport','ReportController@printdata')->name('printreport');

