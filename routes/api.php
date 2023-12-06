<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Authentication
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/user', [AuthenticationController::class, 'CurrentUser']);

    // Posts


});
//users
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'create']);

Route::get('/posts', [PostController::class, 'index']);
// Route::get('/category', [CategoriesController::class, 'index']);
Route::resource('category', CategoriesController::class);
Route::post('/posts', [PostController::class, 'store']);
