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

Route::get('/home', 'JobsController@index')->name('home');
Route::post('/jobs/create', 'JobsController@store');
Route::put('/jobs/approve/{job}', 'JobsController@update');
Route::post('/user/apply/{job}', 'UserJobController@addJob');
Route::post('/user/remove/{job}', 'UserJobController@removeJob');
