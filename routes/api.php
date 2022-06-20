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

Route::controller(TodoController::class)->prefix('todos')->group(function() {

    Route::get('', 'getTodos');

    Route::post('', 'createTodo');

    Route::prefix('{todoId}')->group(function() {

        Route::put('', 'updateTodo');

        Route::delete('', 'deleteTodo');

        Route::post('mark-as-done', 'markTodoAsDone');

    });

});
