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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/game', 'HomeController@game')->name('game');





//testing routes
Route::get('/edgeCase', function () {
    //test the edge browser
    return view('test.edge');
});

Route::get('/mailtest', function () {
    return new App\Mail\Welcome();
});

Route::get('/cache_status', function () {
    require('../vendor/amnuts/opcache-gui/index.php');
});