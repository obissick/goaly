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
Route::get('/goals', 'GoalController@index')->name('goal');

Route::get('/goals/create', 'GoalController@create')->name('newgoal');
Route::post('/goals', 'GoalController@store')->name('store');
Route::get('/goals/{id}', 'GoalController@show')->name('showgoal');