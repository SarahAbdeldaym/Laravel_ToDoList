<?php

use App\Http\Controllers\TodoController;
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

Route::group([ 'prefix' => 'todos' ], function() {

    Route::get('', [ 'uses' => TodoController::class.'@getTodos' ]);

    Route::post('', ['uses' => TodoController::class.'@createTodo' ]);  

    Route::put('{todoId}', ['uses' => TodoController::class.'@updateTodo' ]);   
    
    Route::delete('{todoId}', ['uses' => TodoController::class.'@deleteTodo' ]);  
});
