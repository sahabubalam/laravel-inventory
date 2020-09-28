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
Route::post('/insert-employee', 'EmployeeController@store');
Route::get('/all-employee', 'EmployeeController@all_employee')->name('all.employee');
Route::get('/delete-employee/{id}', 'EmployeeController@deleteemployee');
Route::get('/edit-employee/{id}', 'EmployeeController@editemployee');
Route::post('/update-employee/{id}', 'EmployeeController@update_employee');
