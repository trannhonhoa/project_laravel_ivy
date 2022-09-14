<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryBlogController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogClientController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainClientController;
use App\Http\Controllers\MenuClientController;
use App\Http\Controllers\ProductClientController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;


Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('store', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });
        #Menu
        Route::prefix('category')->group(function () {
            Route::get('add', [CategoryBlogController::class, 'create']);
            Route::post('store', [CategoryBlogController::class, 'store']);
            Route::get('list', [CategoryBlogController::class, 'index']);
            Route::get('edit/{menu}', [CategoryBlogController::class, 'show']);
            Route::post('edit/{menu}', [CategoryBlogController::class, 'update']);
            Route::DELETE('destroy', [CategoryBlogController::class, 'destroy']);
        });
        #Menu
        Route::prefix('blogs')->group(function () {
            Route::get('add', [BlogController::class, 'create']);
            Route::post('store', [BlogController::class, 'store']);
            Route::get('list', [BlogController::class, 'index']);
            Route::get('edit/{blog}', [BlogController::class, 'show']);
            Route::post('edit/{blog}', [BlogController::class, 'update']);
            Route::DELETE('destroy', [BlogController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('store', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('store', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });
    });
});
#Upload
Route::post('upload/services', [UploadController::class, 'store']);
Route::get('/', [MainClientController::class, 'index'])->name('main-client');
Route::post('/services/load-product', [MainClientController::class, 'loadProduct']);


Route::get('/bai-viet/{id}-{slug}.html', [BlogClientController::class, 'index']);

Route::get('danh-muc/{id}-{slug}.html', [MenuClientController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [ProductClientController::class, 'index']);

Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'destroy']);
Route::post('carts', [CartController::class, 'addCart']);


// authentication
Route::get('/register', [AuthController::class, 'showformregister'])->name('show-form-register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showformlogin'])->name('show-form-login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [AuthController::class, 'showformprofile'])->name('show-form-profile');
Route::post('/profile', [AuthController::class, 'profile'])->name('profile');

Route::middleware(['checklogin'])->group(function () {
    Route::get('/bai-viet.html', [BlogClientController::class, 'index']);
});
