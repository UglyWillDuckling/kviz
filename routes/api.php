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


/*
 * test routes
 * */
Route::middleware('api')->get('/tasks', function (Request $request) {

    $tasks = App\Task::latest()->get();

    if ($tasks) {
        return [
            'success' => true,
            'tasks' => $tasks,
        ];
    }
});

Route::middleware('api')->get('/question', function (Request $request) {

    $questions = App\Question::with('category')->get();

    if ($questions) {
        return [
            'success' => true,
            'questions' => $questions,
        ];
    }
});
