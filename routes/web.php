<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

//post
Route::get('/posts/create', [PostController::class, 'create'])->name('post-create')->middleware(['auth']);
Route::post('/posts', [PostController::class, 'store'])->name('post-store');
Route::get('/posts', [PostController::class, 'index'])->name('post-index');
Route::get('/posts/search', [PostController::class, 'search']) ->name('post-search');
Route::get('/posts/{post}', [PostController::class, 'show']) ->name('post-show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post-destroy')->middleware(['auth'])->can('edit-post', 'post');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post-edit')->middleware(['auth'])->can('edit-post', 'post');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post-update')->middleware(['auth'])->can('edit-post', 'post');

//Route::get('/likes/{post}',[LikeController::class,'index']) ;
Route::post('likes/{post}', [LikeController::class, 'store'])->name('like-store')->middleware('auth');
Route::delete('likes/{post}', [LikeController::class, 'destroy'])->name('like-destroy');

Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment-store')->middleware('auth');
Route::post('/notifications/mark-as-read/{id}', [CommentController::class, 'markAsRead'])->name('notification-markAsRead');
//auth
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register-create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register-store');

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login-store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

//user
Route::get('/user/{user}', [UserController::class, 'index'])->name('user-index');
Route::get('/user/liked/{user}', [UserController::class, 'showLikedPosts'])->name('user-showLikedPosts');
Route::get('/user/commented/{user}', [UserController::class, 'showCommentedPosts'])->name('user-showCommentedPosts');

//password
Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password-edit');
Route::patch('/password/update', [PasswordController::class, 'update'])->middleware(['auth'])->name('password-update');

//export
Route::get('/downloadPdf',[PostController::class,'exportPdf'])->name('export-pdf');
Route::get('/downloadExcel',[PostController::class,'exportExcel'])->name('export-excel');
Route::get('/downloadCsv',[PostController::class,'exportCsv'])->name('export-csv');






