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
    Route::get($name = 'login', sprintf('%s@showLoginForm', \App\Http\Controllers\Auth\LoginController::class))->name($name);
    Route::post($name,  sprintf('%s@%s', \App\Http\Controllers\Auth\LoginController::class, $name));
    Route::post($name = 'logout', sprintf('%s@%s', \App\Http\Controllers\Auth\LoginController::class, $name))->name($name);

    /**
     * Registration
     */
    if (app()->isLocal()) {// TODO
        Route::get($name = 'register', sprintf('%s@showRegistrationForm', \App\Http\Controllers\Auth\RegisterController::class))->name($name);
        Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Auth\RegisterController::class, $name));
    }

    /**
     * Password Reset
     */
    Route::prefix($prefix = 'password')->name(sprintf('%s.', $prefix))->group(function () {
        Route::post($name = 'email', sprintf('%s@sendResetLinkEmail', \App\Http\Controllers\Auth\Password\ForgotController::class))->name($name);
        Route::get($name = 'reset', sprintf('%s@showLinkRequestForm', \App\Http\Controllers\Auth\Password\ForgotController::class))->name('request');
        Route::get(sprintf('%s/{token}', $name), sprintf('%s@showResetForm', \App\Http\Controllers\Auth\Password\ResetController::class))->name($name);
        Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Auth\Password\ResetController::class, $name));
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
            Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\Customers\UpdateController::class))->name($name);
            Route::post($name, sprintf('%s@update', \App\Http\Controllers\Customers\UpdateController::class));
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
            Route::get($name = 'import', sprintf('%s@view', \App\Http\Controllers\Customers\Files\ImportController::class))->name($name);
            Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Customers\Files\ImportController::class, $name));
        });
    });

    /**
     * Reservations
     */
    if (app()->isLocal()) {// TODO
        Route::prefix($prefix = 'reservations')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get('/', \App\Http\Controllers\Reservations\IndexController::class)->name('index');
            Route::post($name = 'add', \App\Http\Controllers\Reservations\CreateController::class)->name($name);

            Route::prefix('{reservationId}')->group(function () {
                Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\Reservations\UpdateController::class))->name($name);
                Route::post($name, sprintf('%s@update', \App\Http\Controllers\Reservations\UpdateController::class));
                Route::post($name = 'delete', \App\Http\Controllers\Reservations\DeleteController::class)->name($name);

                Route::prefix($prefix = 'visited_histories')->name(sprintf('%s.', $prefix))->group(function () {
                    Route::post($name = 'add', \App\Http\Controllers\Reservations\VisitedHistories\CreateController::class)->name($name);
                });
            });
        });
    }

    /**
     * Settings
     */
    Route::prefix($prefix = 'settings')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'company', sprintf('%s@view', \App\Http\Controllers\Settings\Company\UpdateController::class))->name($name);
        Route::post($name, sprintf('%s@update', \App\Http\Controllers\Settings\Company\UpdateController::class));

        Route::get($name = 'profile', sprintf('%s@view', \App\Http\Controllers\Settings\Profile\UpdateController::class))->name($name);
        Route::post($name, sprintf('%s@update', \App\Http\Controllers\Settings\Profile\UpdateController::class));

        Route::get($name = 'store', sprintf('%s@view', \App\Http\Controllers\Settings\Store\UpdateController::class))->name($name);
        Route::post($name, sprintf('%s@update', \App\Http\Controllers\Settings\Store\UpdateController::class));

        Route::get($name = 'printings', sprintf('%s@view', \App\Http\Controllers\Settings\Printings\UpdateController::class))->name($name);
        Route::post(sprintf('%s/{settingId}', $name), sprintf('%s@update', \App\Http\Controllers\Settings\Printings\UpdateController::class))->name(sprintf('%s.update', $name));
    });

    /**
     * Tags
     */
    Route::prefix($prefix = 'tags')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Tags\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Tags\CreateController::class)->name($name);

        Route::prefix('{tagId}')->group(function () {
            Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\Tags\UpdateController::class))->name($name);
            Route::post($name, sprintf('%s@update', \App\Http\Controllers\Tags\UpdateController::class));
            Route::post($name = 'delete', \App\Http\Controllers\Tags\DeleteController::class)->name($name);
        });
    });

    /**
     * Users
     */
    if (app()->isLocal()) {// TODO
        Route::prefix($prefix = 'users')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get('/', \App\Http\Controllers\Users\IndexController::class)->name('index');
            Route::post($name = 'add', \App\Http\Controllers\Users\CreateController::class)->name($name);

            Route::prefix('{userId}')->group(function () {
                Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\Users\UpdateController::class))->name($name);
                Route::post($name, sprintf('%s@update', \App\Http\Controllers\Users\UpdateController::class));
                Route::post($name = 'delete', \App\Http\Controllers\Users\DeleteController::class)->name($name);
                Route::post($name = 'restore', \App\Http\Controllers\Users\RestoreController::class)->name($name);
            });
        });
    }

    /**
     * Visited histories
     */
    Route::prefix($prefix = 'visited_histories')->name(sprintf('%s.', $prefix))->group(function () {
        Route::post($name = 'add', \App\Http\Controllers\VisitedHistories\CreateController::class)->name($name);

        Route::prefix('{visitedHistoryId}')->group(function () {
            Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\VisitedHistories\UpdateController::class))->name($name);
            Route::post($name, sprintf('%s@update', \App\Http\Controllers\VisitedHistories\UpdateController::class));
            Route::post($name = 'delete', \App\Http\Controllers\VisitedHistories\DeleteController::class)->name($name);
        });
    });

    /**
     * Notifications
     */
    Route::prefix($prefix = 'notifications')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'test', \App\Http\Controllers\Notifications\TestController::class)->name($name);
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
    Route::get($name = 'login', sprintf('%s@showLoginForm', \App\Http\Controllers\Systems\Auth\LoginController::class))->name($name);
    Route::post($name,  sprintf('%s@%s', \App\Http\Controllers\Systems\Auth\LoginController::class, $name));
    Route::post($name = 'logout', sprintf('%s@%s', \App\Http\Controllers\Systems\Auth\LoginController::class, $name))->name($name);

    /**
     * Docs
     */
    Route::prefix($prefix = 'docs')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'permissions', \App\Http\Controllers\Systems\Docs\Permissions\IndexController::class)->name($name);
    });

    /**
     * Registration
     */
    Route::get($name = 'register', sprintf('%s@showRegistrationForm', \App\Http\Controllers\Systems\Auth\RegisterController::class))->name($name);
    Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Systems\Auth\RegisterController::class, $name));

    /**
     * Password Reset
     */
    Route::prefix($prefix = 'password')->name(sprintf('%s.', $prefix))->group(function () {
        Route::post($name = 'email', sprintf('%s@sendResetLinkEmail', \App\Http\Controllers\Systems\Auth\Password\ForgotController::class))->name($name);
        Route::get($name = 'reset', sprintf('%s@showLinkRequestForm', \App\Http\Controllers\Systems\Auth\Password\ForgotController::class))->name('request');
        Route::get(sprintf('%s/{token}', $name), sprintf('%s@showResetForm', \App\Http\Controllers\Systems\Auth\Password\ResetController::class))->name($name);
        Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Systems\Auth\Password\ResetController::class, $name));
    });
});
