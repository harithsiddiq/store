<?php
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('logout', [Dashboard\AdminController::class, 'logout'])->name('admin.logout');



Route::group(['middleware' => ['localizationRedirect', 'localeSessionRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()], function () {

    // Login Route
    Route::group(['middleware' => 'guest:admin', 'prefix' => 'dashboard'], function () {
        Route::get('login', [Dashboard\AdminController::class, 'loginForm'])->name('admin.loginForm');
        Route::post('login', [Dashboard\AdminController::class, 'login'])->name('admin.login');
    });

    // Admin Dashboard
    Route::group(['middleware' => 'auth:admin', 'prefix' => 'dashboard'], function() {
        Route::get('', [Dashboard\AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Category
        Route::group(['prefix' => 'category'], function() {
            Route::get('', [Dashboard\CategoryController::class, 'index'])->name('category.index');
            Route::post('', [Dashboard\CategoryController::class, 'store'])->name('category.save');
            Route::get('create', [Dashboard\CategoryController::class, 'create'])->name('category.create');
        });

    });

});

Route::get('test', function () {
   return auth('admin')->guard('admin')->user();
   return load_categories();
});




