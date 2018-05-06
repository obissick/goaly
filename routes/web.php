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
})->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/feed', 'FeedController@index')->name('feed');
Route::resource('goal', 'GoalController');
Route::post('goal/{id}/complete', 'GoalController@complete')->name('goal.complete');
Route::post('goal/{id}/reopen', 'GoalController@reopen')->name('goal.reopen');
Route::resource('comment', 'CommentController');
Route::get('/follows', 'GoalFollowController@index')->name('followedgoals');
Route::post('goal/{id}/follow', 'GoalFollowController@store')->name('followgoal');
Route::delete('goal/{id}/unfollow', 'GoalFollowController@destroy')->name('unfollowgoal');
Route::post('goal/{id}/like', 'GoalLikeController@store')->name('goal.like');
Route::delete('goal/{id}/unlike', 'GoalLikeController@destroy')->name('goal.unlike');

Route::get('phpinfo', function () {
    return phpinfo();
});