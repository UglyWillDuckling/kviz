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


Route::delete('/task/{task}', function ($task) {
    //$task->delete();
    return [
        'success' => true,
    ];
});

/*
 * Admin routes
 */
Route::middleware(['can:accessAdminpanel'])->namespace('Admin')->group(function () {
    Route::get('/admin/dashboard', 'AdminController@index')
        ->name('admin');

    Route::get('/admin/questions', 'AdminController@questions')
        ->name('admin.questions');

    Route::get('/admin/question/edit/{id}', 'AdminController@question')
        ->name('admin.question');
    Route::get('/admin/question/create', 'AdminController@createQuestion')
        ->name('admin.question');

    Route::post('/admin/question/edit', 'AdminController@editQuestion')
        ->name('admin.question.edit.post');
});


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