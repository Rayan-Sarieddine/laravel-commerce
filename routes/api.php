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


Route::post("/addProduct", [ProductssController::class,"addProduct"]);
Route::post("/deleteProduct", [ProductssController::class,"deleteProduct"]);
Route::post("/updateProduct", [ProductssController::class,"updateProduct"]);
Route::get("/getAllProducts", [ProductssController::class,"getAllProducts"]);
Route::post("/getProduct", [ProductssController::class,"getProduct"]);


// Route::post("/signUp", [UsersController::class,"signUp"]);
// Route::post("/signIn", [UsersController::class,"signIn"]);
Route::post("/getUser", [UsersController::class,"getUser"]);
Route::get("/getAllUsers", [UsersController::class,"getAllUsers"]);
Route::post("/updateUser", [UsersController::class,"updateUser"]);
Route::post("/order", [OrdersController::class,"order"]);