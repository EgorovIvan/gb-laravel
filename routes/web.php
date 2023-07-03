<?php

use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DataSourceController as AdminDataSourceController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])
    ->name('main.index');

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function() {
    Route::get('/', AdminController::class)
        ->name('index');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
    Route::resource('/data-sources', AdminDataSourceController::class);
});

// Guest's routes

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');
Route::get('/news/order', [NewsController::class, 'order'])
    ->name('news.order');

Route::post('/news/store', [NewsController::class, 'store'])
    ->name('news.store');

Route::match(["POST", 'GET', 'PUT'], '/test', function(\Illuminate\Http\Request $request) {
    return (int) $request->isMethod('GET');
});


