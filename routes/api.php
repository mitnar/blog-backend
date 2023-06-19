<?php

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

use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthController;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('posts')->group(function() {
        Route::resource('/', PostController::class);
        Route::get('/recents', [PostController::class, 'getRecents']);
        Route::get('/my', [PostController::class, 'getAuthorizedUserPosts']);
    });

    Route::post('/moderator/posts/{id}/block', [PostController::class, 'setBlocked']);
});
