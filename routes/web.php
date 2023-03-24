<?php

    use App\Http\Controllers\AuthController;
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
    });


