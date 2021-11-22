<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('lists/{id?}', [TodoController::class, 'list']);
Route::post('addTodo', [TodoController::class, 'addTodo']);
Route::put('updateTodo', [TodoController::class, 'updateTodo']);
Route::post('complete-Todo', [TodoController::class, 'completeTodo']);
//Route::post('completeTodo', [TodoController::class, 'completeTodo']);
Route::delete('delete/{id}', [TodoController::class, 'deleteTodo']);
