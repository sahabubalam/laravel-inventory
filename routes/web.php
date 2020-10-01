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
//category route==============
Route::get('/add-category', 'CategoryController@index')->name('add.category');
Route::post('/insert-category', 'CategoryController@store');
Route::get('/all-category', 'CategoryController@all_category')->name('all.category');
Route::get('/delete-category/{id}', 'CategoryController@delete_category');
Route::get('/edit-category/{id}', 'CategoryController@edit_category');
Route::post('/update-category/{id}', 'CategoryController@update_category');
//category route==============
Route::get('/add-product', 'ProductController@index')->name('add.product');
Route::post('/insert-product', 'ProductController@store');
Route::get('/all-product', 'ProductController@all_product')->name('all.product');
Route::get('/delete-product/{id}', 'ProductController@delete_product');
Route::get('/edit-product/{id}', 'ProductController@edit_product');
Route::post('/update-product/{id}', 'ProductController@update_product');
//expense route==============
Route::get('/add-expense', 'ExpenseController@index')->name('add.expense');
Route::post('/insert-expense', 'ExpenseController@store');
Route::get('/today-expense', 'ExpenseController@today_expense')->name('today.expense');
Route::get('/edit-today-expense/{id}', 'ExpenseController@edit_today_expense');
Route::post('/update-today-expense/{id}', 'ExpenseController@update_today_expense');
Route::get('/month-expense', 'ExpenseController@monthly_expense')->name('month.expense');
Route::get('/year-expense', 'ExpenseController@yearly_expense')->name('year.expense');
//individual monthly expense

Route::get('/January-expense', 'ExpenseController@january_expense')->name('January.expense');
Route::get('/February-expense', 'ExpenseController@february_expense')->name('February.expense');
Route::get('/March-expense', 'ExpenseController@march_expense')->name('March.expense');
Route::get('/April-expense', 'ExpenseController@april_expense')->name('April.expense');
Route::get('/May-expense', 'ExpenseController@may_expense')->name('May.expense');
Route::get('/June-expense', 'ExpenseController@june_expense')->name('June.expense');
Route::get('/July-expense', 'ExpenseController@july_expense')->name('July.expense');
Route::get('/August-expense', 'ExpenseController@august_expense')->name('August.expense');
Route::get('/September-expense', 'ExpenseController@september_expense')->name('September.expense');
Route::get('/October-expense', 'ExpenseController@october_expense')->name('October.expense');
Route::get('/November-expense', 'ExpenseController@november_expense')->name('November.expense');
Route::get('/December-expense', 'ExpenseController@december_expense')->name('December.expense');

//attendence route==============
Route::get('/take-attendence', 'AttendenceController@take_attendence')->name('take.attendence');
Route::get('/all-attendence', 'AttendenceController@all_attendence')->name('all.attendence');
Route::post('/insert-attendence', 'AttendenceController@store');
//setting route==============
Route::get('/website-setting', 'AttendenceController@Setting')->name('setting');
Route::get('/edit-attendence/{edit_date}', 'AttendenceController@edit_attendence');
