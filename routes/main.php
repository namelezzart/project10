<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Posts\CommentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::redirect('/home', '/')->name('home.redirect');
// Route::get('/test', TestController::class)->name('test')->middleware('token');
Route::get('/test', TestController::class)->name('test');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::post('blog/{post}/like', [BlogController::class, 'like'])->name('blog.like');

//CRUD (create, read, update, delete)
// Создает все стандартные маршруты, аргуметы в методе only создаст только заданные маршруты, вместо only except создает исключение
// Route::resource('posts', PostController::class) -> only(['index', 'show']);

Route::resource('posts/{post}/comments', CommentController::class);