<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:api'])->namespace('Api')->group(function () {

    Route::get('questions', 'Question@index')->name('api.questions');
    Route::get('question', 'Question@question')->name('api.question');


    Route::get('categories', 'Category@index')->name('api.categories');
    Route::get('category', 'Category@category')->name('api.category');

});


Route::middleware('api')->get('questions', 'Api\Question@index')->name('api.questions');
Route::middleware('api')->get('question', 'Api\Question@question')->name('api.question');

Route::middleware('api')->get('categories', 'Api\Category@index')->name('api.categories');

