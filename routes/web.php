<?php

use Illuminate\Support\Facades\Route;

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


