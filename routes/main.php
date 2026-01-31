<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Posts\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return response()->json(['status' => 'ok']);
});
// Главная страница
Route::get('/', function () {
    return view('home.index');
})->name('home');

// Маршруты аутентификации (доступны только гостям)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

// Выход (доступен только авторизованным)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::post('blog/{post}/like', [BlogController::class, 'like'])->name('blog.like');

//CRUD (create, read, update, delete)
// Создает все стандартные маршруты, аргуметы в методе only создаст только заданные маршруты, вместо only except создает исключение
// Route::resource('posts', PostController::class) -> only(['index', 'show']);

Route::resource('posts/{post}/comments', CommentController::class);
