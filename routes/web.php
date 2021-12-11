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

// Route::get('/', function () {
    // return view('welcome');
    Route::get('/', 'DashboardController@index');
    Route::get('/edit/{slug}', 'DashboardController@edit');
    Route::get('/create', 'DashboardController@create');
    Route::post('/createprosess', 'DashboardController@create_prosess');
    Route::post('/edit/updateprosess', 'DashboardController@update_prosess');
// });

