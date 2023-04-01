<?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\BasketController;
    use App\Http\Controllers\CatalogController;
    use App\Http\Controllers\ForgotPasswordController;
    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', IndexController::class)->name('index');

    Route::middleware("auth")->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
//        Route::get('index', [UserController::class, 'index'])->name('user.index');
        Route::name('user.')->prefix('user')->group(function () {
            Route::get('index', [UserController::class, 'index'])->name('index');
        });
    });

    Route::middleware("guest")->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/login/process', [AuthController::class, 'login'])->name('auth.loginProcess');

        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('auth.register');
        Route::post('/register/process', [RegisterController::class, 'register'])->name('auth.registerProcess');

        Route::get('/forgot/password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name(
            'auth.forgotPassword'
        );
        Route::post('/forgot/password/process', [ForgotPasswordController::class, 'forgotPassword'])->name(
            'auth.forgotPasswordProcess'
        );
        Route::get('/complete/forgot/password', [ForgotPasswordController::class, 'showCompleteForgotPassword'])->name(
            'auth.completeForgotPassword'
        );
    });

    Route::get('/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/category/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
    Route::get('/catalog/brand/{slug}', [CatalogController::class, 'brand'])->name('catalog.brand');
    Route::get('/catalog/product/{slug}', [CatalogController::class, 'product'])->name('catalog.product');

    Route::get('/basket/index', [BasketController::class, 'index'])->name('basket.index');
    Route::get('/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');

    Route::post('/basket/add/{id}', [BasketController::class, 'add'])
        ->where('id', '[0-9]+')
        ->name('basket.add');

    Route::post('/basket/plus/{id}', [BasketController::class, 'plus'])
        ->where('id', '[0-9]+')
        ->name('basket.plus');
    Route::post('/basket/minus/{id}', [BasketController::class, 'minus'])
        ->where('id', '[0-9]+')
        ->name('basket.minus');

    Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])
        ->where('id', '[0-9]+')
        ->name('basket.remove');

    Route::post('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');