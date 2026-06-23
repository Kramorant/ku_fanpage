<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\BuildController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\KaijuController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/kaijus', [KaijuController::class, 'index']);
Route::get('/kaijus/{kaiju}', [KaijuController::class, 'show']);
Route::get('/kaijus/{kaiju}/build', [BuildController::class, 'show']);
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{event}', [EventController::class, 'show']);
Route::get('/blog', [BlogPostController::class, 'index']);
Route::get('/blog/{post}', [BlogPostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn () => request()->user());

    Route::post('/kaijus/{kaiju}/favourite', [FavouriteController::class, 'toggle']);
    Route::get('/user/favourites', [FavouriteController::class, 'index']);

    Route::post('/kaijus/{kaiju}/comments', [CommentController::class, 'storeForKaiju']);
    Route::post('/blog/{post}/comments', [CommentController::class, 'storeForBlogPost']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});
