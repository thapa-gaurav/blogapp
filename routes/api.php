<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//post
Route::get('/posts', [PostController::class, 'index'])->name('post-index');
Route::get('/posts/{post}', [PostController::class, 'show']) ->name('post-show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post-destroy');


Route::get('/test', function () {
    return ['message' => 'API working'];
});
