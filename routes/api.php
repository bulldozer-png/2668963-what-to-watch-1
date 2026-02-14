<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SimilarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::patch('/user', [UserController::class, 'update'])->middleware('auth:sanctum');

Route::get('/films', [FilmController::class, 'index']);
Route::get('/films/{id}', [FilmController::class, 'show']);
Route::post('/films', [FilmController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/films/{id}', [FilmController::class, 'update'])->middleware('auth:sanctum');

Route::get('/genres', [GenreController::class, 'index']);
Route::patch('/genres/{genre}', [GenreController::class, 'update'])->middleware('auth:sanctum');

Route::get('/favorite', [FavoriteController::class, 'index'])->middleware('auth:sanctum');
Route::post('/films/{id}/favorite', [FavoriteController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/films/{id}/favorite', [FavoriteController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/films/{id}/similar', [SimilarController::class, 'similar']);

Route::get('/comments/{id}', [ReviewController::class, 'show']);
Route::post('/comments/{id}', [ReviewController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/comments/{comment}', [ReviewController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/comments/{comment}', [ReviewController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/promo', [PromoController::class, 'promoGet']);
Route::post('/promo/{id}', [PromoController::class, 'promoSet']);