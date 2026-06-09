<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Api\Admin\PlayerController as AdminPlayerController;

// ══════════════════════════════════════════════
//  Auth
// ══════════════════════════════════════════════
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login',    [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/me',      [AuthController::class, 'me'])->name('me');
    });
});

// ══════════════════════════════════════════════
//  Public Routes
// ══════════════════════════════════════════════
Route::get('/news',                    [NewsController::class, 'index']);
Route::get('/news/{slug}',             [NewsController::class, 'show']);
Route::get('/news/breaking',           [NewsController::class, 'breaking']);
Route::get('/categories',              [CategoryController::class, 'index']);
Route::get('/categories/{slug}/news',  [CategoryController::class, 'news']);
Route::get('/teams',                   [TeamController::class, 'index']);
Route::get('/teams/{slug}',            [TeamController::class, 'show']);
Route::get('/teams/{slug}/news',       [TeamController::class, 'news']);
Route::get('/players',                 [PlayerController::class, 'index']);
Route::get('/players/{slug}',          [PlayerController::class, 'show']);

// ══════════════════════════════════════════════
//  Authenticated Routes
// ══════════════════════════════════════════════
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/news/{news}/comments',    [CommentController::class, 'store']);
    Route::delete('/comments/{comment}',   [CommentController::class, 'destroy']);
    Route::post('/bookmarks/{news}',       [BookmarkController::class, 'toggle']);
    Route::get('/bookmarks',               [BookmarkController::class, 'index']);
});

// ══════════════════════════════════════════════
//  Admin Routes
// ══════════════════════════════════════════════
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::apiResource('news',       AdminNewsController::class);
    Route::apiResource('categories', AdminCategoryController::class);
    Route::apiResource('teams',      AdminTeamController::class);
    Route::apiResource('players',    AdminPlayerController::class);

    Route::patch('/news/{news}/toggle-breaking',   [AdminNewsController::class, 'toggleBreaking']);
    Route::patch('/news/{news}/toggle-published',  [AdminNewsController::class, 'togglePublished']);
});
