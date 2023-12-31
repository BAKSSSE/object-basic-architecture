<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\MovieController;

use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Member\MemberController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::get('/member/changePassword', [MemberController::class, 'changePassword']);

Route::get('/order', [OrderController::class, 'order']);











Route::get('/ping', [AppController::class, 'ping']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'read']);



Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'create']);
Route::patch('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

Route::post('/sign-up', [AuthController::class, 'signUp']);
Route::post('/sign-in', [AuthController::class, 'signIn']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/posts', [PostController::class, 'create']);
    Route::patch('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'delete']);


    Route::post('/posts/{postId}/comments', [CommentController::class, 'create']);
    Route::delete('/posts/{postId}/comments/{id}', [CommentController::class, 'delete']);
});

Route::get('/movie', [MovieController::class, 'test']);