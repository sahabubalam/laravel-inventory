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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//employee route==============
Route::get('/add-employee', 'EmployeeController@index')->name('add.employee');


Route::get('/all-employee', 'EmployeeController@all_employee')->name('all.employee');
Route::get('/delete-employee/{id}', 'EmployeeController@deleteemployee');
Route::get('/edit-employee/{id}', 'EmployeeController@editemployee');
Route::post('/update-employee/{id}', 'EmployeeController@update_employee');
//customer route==============
Route::get('/add-customer', 'CustomerController@index')->name('add.customer');
Route::post('/insert-customer', 'CustomerController@store');
Route::get('/all-customer', 'CustomerController@all_customer')->name('all.customer');
Route::get('/delete-customer/{id}', 'CustomerController@delete_customer');
Route::get('/edit-customer/{id}', 'CustomerController@edit_customer');
Route::post('/update-customer/{id}', 'CustomerController@update_customer');
//supplier route==============
Route::get('/add-supplier', 'SupplierController@index')->name('add.supplier');
Route::post('/insert-supplier', 'SupplierController@store');
Route::get('/all-supplier', 'SupplierController@all_supplier')->name('all.supplier');
Route::get('/delete-supplier/{id}', 'SupplierController@delete_supplier');
Route::get('/edit-supplier/{id}', 'SupplierController@edit_supplier');
Route::post('/update-supplier/{id}', 'SupplierController@update_supplier');
//salary route==============
Route::get('/add-advanced-salary', 'SalaryController@index')->name('add.salary');
Route::post('/insert-advanced-salary', 'SalaryController@store');
Route::get('/all-salary', 'SalaryController@all_advanced_salary')->name('all.salary');
Route::get('/pay-salary', 'SalaryController@pay_salary')->name('pay.salary');
