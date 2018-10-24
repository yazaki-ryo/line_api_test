<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * @prefix /
 * @middleware web
 */
Route::prefix('/')->group(function () {
    Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

    /**
     * Authentication
     */
    Route::get($name = 'login',  \App\Http\Controllers\Auth\LoginController::class . '@showLoginForm')->name($name);
    Route::post($name,  \App\Http\Controllers\Auth\LoginController::class . '@login');
    Route::post($name = 'logout', \App\Http\Controllers\Auth\LoginController::class . '@logout')->name($name);

    /**
     * Registration
     */
//     Route::get($name = 'register', \App\Http\Controllers\Auth\RegisterController::class . '@showRegistrationForm')->name($name);
//     Route::post($name, \App\Http\Controllers\Auth\RegisterController::class . '@register');

    /**
     * Password Reset
     */
    Route::prefix($prefix = 'password')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('reset',         \App\Http\Controllers\Auth\Password\ForgotController::class . '@showLinkRequestForm')->name('request');
        Route::post('email',         \App\Http\Controllers\Auth\Password\ForgotController::class . '@sendResetLinkEmail')->name('email');
        Route::get('reset/{token}', \App\Http\Controllers\Auth\Password\ResetController::class . '@showResetForm')->name('reset');
        Route::post('reset',         \App\Http\Controllers\Auth\Password\ResetController::class . '@reset');
    });

    /**
     * Customers
     */
    Route::prefix($prefix = 'customers')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Customers\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Customers\CreateController::class)->name($name);

        Route::group([
            'prefix' => '{customerId}',
        ], function () {
            Route::get($name = 'edit', \App\Http\Controllers\Customers\UpdateController::class . '@view')->name($name);
            Route::post($name, \App\Http\Controllers\Customers\UpdateController::class . '@update');
            Route::post($name = 'delete', \App\Http\Controllers\Customers\DeleteController::class)->name($name);
            Route::post($name = 'restore', \App\Http\Controllers\Customers\RestoreController::class)->name($name);

            Route::prefix($prefix = 'tags')->name(sprintf('%s.', $prefix))->group(function () {
                Route::post($name = 'edit', \App\Http\Controllers\Customers\Tags\UpdateController::class)->name($name);
            });
        });

        Route::prefix($prefix = 'postcards')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'export', \App\Http\Controllers\Customers\Postcards\ExportController::class)->name($name);
        });

        Route::prefix($prefix = 'files')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = 'import', \App\Http\Controllers\Customers\Files\ImportController::class . '@view')->name($name);
            Route::post($name, \App\Http\Controllers\Customers\Files\ImportController::class . '@import');
        });
    });

    /**
     * Reservations
     */
    Route::prefix($prefix = 'reservations')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Reservations\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Reservations\CreateController::class)->name($name);

        Route::prefix('{reservationId}')->group(function () {
            Route::get($name = 'edit', \App\Http\Controllers\Reservations\UpdateController::class . '@view')->name($name);
            Route::post($name, \App\Http\Controllers\Reservations\UpdateController::class . '@update');
            Route::post($name = 'delete', \App\Http\Controllers\Reservations\DeleteController::class)->name($name);

            Route::prefix($prefix = 'visited_histories')->name(sprintf('%s.', $prefix))->group(function () {
                Route::post($name = 'add', \App\Http\Controllers\Reservations\VisitedHistories\CreateController::class)->name($name);
            });
        });
    });

    /**
     * Settings
     */
    Route::prefix($prefix = 'settings')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'company', \App\Http\Controllers\Settings\Company\UpdateController::class . '@view')->name($name);
        Route::post($name, \App\Http\Controllers\Settings\Company\UpdateController::class . '@update');
        Route::get($name = 'profile', \App\Http\Controllers\Settings\Profile\UpdateController::class . '@view')->name($name);
        Route::post($name, \App\Http\Controllers\Settings\Profile\UpdateController::class . '@update');
        Route::get($name = 'store', \App\Http\Controllers\Settings\Store\UpdateController::class . '@view')->name($name);
        Route::post($name, \App\Http\Controllers\Settings\Store\UpdateController::class . '@update');
        Route::get($name = 'printings', \App\Http\Controllers\Settings\Printings\UpdateController::class . '@view')->name($name);
        Route::post(sprintf('%s/{settingId}', $name), \App\Http\Controllers\Settings\Printings\UpdateController::class . '@update')->name(sprintf('%s.update', $name));
    });

    /**
     * Tags
     */
    Route::prefix($prefix = 'tags')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Tags\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Tags\CreateController::class)->name($name);

        Route::prefix('{tagId}')->group(function () {
            Route::get($name = 'edit', \App\Http\Controllers\Tags\UpdateController::class . '@view')->name($name);
            Route::post($name, \App\Http\Controllers\Tags\UpdateController::class . '@update');
            Route::post($name = 'delete', \App\Http\Controllers\Tags\DeleteController::class)->name($name);
        });
    });

    /**
     * Users
     */
    Route::prefix($prefix = 'users')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Users\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Users\CreateController::class)->name($name);

        Route::prefix('{userId}')->group(function () {
            Route::get($name = 'edit', \App\Http\Controllers\Users\UpdateController::class . '@view')->name($name);
            Route::post($name, \App\Http\Controllers\Users\UpdateController::class . '@update');
            Route::post($name = 'delete', \App\Http\Controllers\Users\DeleteController::class)->name($name);
            Route::post($name = 'restore', \App\Http\Controllers\Users\RestoreController::class)->name($name);
        });
    });

    /**
     * Visited histories
     */
    Route::prefix($prefix = 'visited_histories')->name(sprintf('%s.', $prefix))->group(function () {
        Route::post($name = 'add', \App\Http\Controllers\VisitedHistories\CreateController::class)->name($name);

        Route::prefix('{visitedHistoryId}')->group(function () {
            Route::get($name = 'edit', \App\Http\Controllers\VisitedHistories\UpdateController::class . '@view')->name($name);
            Route::post($name, \App\Http\Controllers\VisitedHistories\UpdateController::class . '@update');
            Route::post($name = 'delete', \App\Http\Controllers\VisitedHistories\DeleteController::class)->name($name);
        });
    });

    /**
     * Notifications
     */
    Route::prefix($prefix = 'notifications')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'test', \App\Http\Controllers\Notifications\TestController::class)->name($name);
    });

    /**
     * Docs
     */
    Route::prefix($prefix = 'docs')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'permissions', \App\Http\Controllers\Docs\Permissions\IndexController::class)->name($name);
    });
});

/**
 * @prefix systems
 * @middleware web
 */
Route::prefix($prefix = 'systems')->name(sprintf('%s.', $prefix))->group(function () {
    Route::get('/', \App\Http\Controllers\Systems\HomeController::class)->name('home');

    /**
     * Authentication
     */
    Route::get($name = 'login',  \App\Http\Controllers\Systems\Auth\LoginController::class . '@showLoginForm')->name($name);
    Route::post($name,  \App\Http\Controllers\Systems\Auth\LoginController::class . '@login');
    Route::post($name = 'logout', \App\Http\Controllers\Systems\Auth\LoginController::class . '@logout')->name($name);

    /**
     * Registration
     */
    Route::get($name = 'register', \App\Http\Controllers\Systems\Auth\RegisterController::class . '@showRegistrationForm')->name($name);
    Route::post($name, \App\Http\Controllers\Systems\Auth\RegisterController::class . '@register');

    /**
     * Password Reset
     */
    Route::prefix($prefix = 'password')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('reset',         \App\Http\Controllers\Systems\Auth\Password\ForgotController::class . '@showLinkRequestForm')->name('request');
        Route::post('email',         \App\Http\Controllers\Systems\Auth\Password\ForgotController::class . '@sendResetLinkEmail')->name('email');
        Route::get('reset/{token}', \App\Http\Controllers\Systems\Auth\Password\ResetController::class . '@showResetForm')->name('reset');
        Route::post('reset',         \App\Http\Controllers\Systems\Auth\Password\ResetController::class . '@reset');
    });
});
