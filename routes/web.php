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

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	Route::get('/home/products', 'BillingController@createBill')->name('bill.create');
	Route::post('/home/products', 'BillingController@saveBill')->name('bill.save');

	Route::get('/home/customers', 'HomeController@viewCustomers')->name('customers');
	Route::get('/home/customers/{id}', 'HomeController@viewCustomer')->name('customer');

	Route::get('/home/bills/{id}', 'HomeController@viewBill')->name('bill');
	
});