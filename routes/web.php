<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DataSourceController as AdminDataSourceController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])
    ->name('main.index');

Route::group(['middleware' => 'auth'], static function () {
    Route::group(['prefix' => 'account'], static function () {
        Route::get('/', AccountController::class)->name('account');
    });

    // Admin
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'check.admin',

    ], static function () {
        Route::get('/', AdminController::class)
            ->name('index');
        Route::resource('/categories', AdminCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/data-sources', AdminDataSourceController::class);
        Route::resource('/users', AdminProfileController::class);
    });
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

Route::get('/sessions', function () {
    session()->put('mysession', 'Test session');
    if (session()->has('mysession')) {
        dd(session()->all(), session()->get('mysession'));
        session()->forget('mysession');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
