<?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\CatalogController;
    use App\Http\Controllers\ForgotPasswordController;
    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\RegisterController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [IndexController::class, 'index'])->name('home');

    Route::middleware("auth")->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::middleware("guest")->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login_process', [AuthController::class, 'login'])->name('login_process');

        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register_process', [RegisterController::class, 'register'])->name('register_process');

        Route::get('/forgot_password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name(
            'forgot_password'
        );
        Route::post('/forgot_password_process', [ForgotPasswordController::class, 'forgotPassword'])->name(
            'forgot_password_process'
        );
        Route::get('/complete_forgot_password', [ForgotPasswordController::class, 'showCompleteForgotPassword'])->name(
            'complete_forgot_password'
        );
    });

    Route::get('/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/category/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
    Route::get('/catalog/brand/{slug}', [CatalogController::class, 'brand'])->name('catalog.brand');
    Route::get('/catalog/product/{slug}', [CatalogController::class, 'product'])->name('catalog.product');


