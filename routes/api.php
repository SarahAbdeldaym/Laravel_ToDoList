<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->prefix('users')->group(function() {

    Route::post('signup', 'signup');

    Route::post('login', 'login');

});

Route::group([ 'prefix' => 'todos' ], function() {

    Route::get('', [ 'uses' => TodoController::class.'@getTodos' ]);

    Route::post('', ['uses' => TodoController::class.'@createTodo' ]);

    Route::put('{todoId}', ['uses' => TodoController::class.'@updateTodo' ]);

    Route::delete('{todoId}', ['uses' => TodoController::class.'@deleteTodo' ]);

    Route::post('{todoId}/mark-as-done', ['uses' => TodoController::class.'@markTodoAsDone' ]);
});
