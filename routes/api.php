<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

//post
Route::get('/posts', [PostController::class, 'index'])->name('post-index');
Route::post('/posts', [PostController::class, 'store'])->name('post-store')->middleware(['auth:sanctum']);
Route::get('/posts/{postID}', [PostController::class, 'show']) ->name('post-show');
Route::delete('/posts/{postID}', [PostController::class, 'destroy'])->name('post-destroy')->middleware(['auth:sanctum']);
Route::patch('/posts/{postID}', [PostController::class, 'update'])->name('post-update')->middleware(['auth:sanctum']);

//auth
Route::post('/login', [SessionController::class, 'store'])->name('login-store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware(['auth:sanctum']);

//register
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register-store');


//password
Route::patch('/password/update', [PasswordController::class, 'update'])->middleware(['auth:sanctum'])->name('password-update');



