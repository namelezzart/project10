<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Требуют авторизованного пользователя (сессия, как и остальное приложение)
Route::middleware(['web', 'auth'])->group(function () {
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('posts.delete');
    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
});
