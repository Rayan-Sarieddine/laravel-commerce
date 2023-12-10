<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::get('todos', [TodoController::class, 'index']);
Route::post('todo', [TodoController::class, 'store']);
Route::get('todo/{id}', [TodoController::class, 'show']);
Route::put('todo/{id}', [TodoController::class, 'update']);
Route::delete('todo/{id}', [TodoController::class, 'destroy']);