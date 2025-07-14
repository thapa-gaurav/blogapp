<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//post
Route::get('/posts', [PostController::class, 'index'])->name('post-index');
Route::post('/posts', [PostController::class, 'store'])->name('post-store');
Route::get('/posts/{postID}', [PostController::class, 'show']) ->name('post-show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post-destroy');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post-update');

