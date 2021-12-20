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
Route::post('/Create', 'StaffController@create');
Route::get('/index', 'StaffController@index');
Route::get('/edit/getSingleStaff/{id}', 'StaffController@getSingleStaff' );
Route::post('/edit/updateStaff/{id}', 'StaffController@updateStaff' );
Route::post('/staff/deleteStaff/{id}', 'StaffController@deleteStaff' );
Route::get('/searchStaff', 'StaffController@searchStaff');

Route::post('/createDept', 'DepartmentController@createDept');

Route::post('/createDeptUnit', 'DpertmentUnitController@createDeptUnit');


Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');


