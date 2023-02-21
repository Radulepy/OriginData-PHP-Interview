<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//* TEST ROUTE: 
Route::get('/test', function () {
    return response()->json(['success' => 'Hello!']);
});

//* Company GET routes:
Route::get('/company', 'App\Http\Controllers\CompanyController@index');
Route::get('/company/{id}', 'App\Http\Controllers\CompanyController@show');

//* Employee GET routes:
Route::get('/employee', 'App\Http\Controllers\EmployeeController@index');
Route::get('/employee/{id}', 'App\Http\Controllers\EmployeeController@show');

//* Project GET routes:
Route::get('/project', 'App\Http\Controllers\ProjectController@index');
Route::get('/project/{id}', 'App\Http\Controllers\ProjectController@show');

//TODO: api versioning (prefix->('v1')), now no versioning is done: 
Route::middleware('auth:api')->group(function () {

    //* Authentication only: Create, Update and Delet

    // Company Model
    Route::post('/company', 'App\Http\Controllers\CompanyController@store');
    // PUT:
    Route::put('/company/{id}', 'App\Http\Controllers\CompanyController@update');
    // DELETE:
    Route::delete('/company/{id}', 'App\Http\Controllers\CompanyController@destroy');

    // Employee Model
    Route::post('/employee', 'App\Http\Controllers\EmployeeController@store');
    // PUT:
    Route::put('/employee/{id}', 'App\Http\Controllers\EmployeeController@update');
    // DELETE:
    Route::delete('/employee/{id}', 'App\Http\Controllers\EmployeeController@destroy');

    // Project Model
    Route::post('/project', 'App\Http\Controllers\ProjectController@store');
    // PUT:
    Route::put('/project/{id}', 'App\Http\Controllers\ProjectController@update');
    // DELETE:
    Route::delete('/project/{id}', 'App\Http\Controllers\ProjectController@destroy');
});

//* Routes to register or login a user:
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
