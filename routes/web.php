<?php

use App\Http\Controllers\Admin\CreateNewsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [
    HomeController::class, 'index'
]);

Route::get('/admin', [
    IndexController::class, 'index'
]);

Route::get('/admin/add-news', [
    CreateNewsController::class, 'index'
]);

Route::get('/auth', [
    AuthController::class, 'authorization'
]);

Route::get('categories/{categoryId}/news/{id}',
    [NewsController::class, 'show']
)->name('news.show');

Route::get('/categories', [
    CategoryNewsController::class, 'categories'
]);

Route::get('/categories/{id}', [
    CategoryNewsController::class, 'show'
])->name('category.show');

