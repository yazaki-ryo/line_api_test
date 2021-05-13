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

//Route::get('/contact', 'ContactController@form')->name('form');
//Route::post('/contact/confirm', 'ContactController@confirm')->name('confirm');
//Route::post('/contact/process', 'ContactController@process')->name('process');

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
     * line
     */
    Route::get('contact', sprintf('%s@form', \App\Http\Controllers\Line\ContactController::class))->name('form');
    Route::post('/contact/confirm', sprintf('%s@confirm', \App\Http\Controllers\Line\ContactController::class))->name('confirm');
    Route::post('/contact/process', sprintf('%s@process', \App\Http\Controllers\Line\ContactController::class))->name('process');

    Route::get('schedule', sprintf('%s@index', \App\Http\Controllers\Line\ScheduleController::class))->name('schedule');

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
    // Route::prefix($prefix = 'password')->name(sprintf('%s.', $prefix))->group(function () {
    //     Route::post($name = 'email', sprintf('%s@sendResetLinkEmail', \App\Http\Controllers\Auth\Password\ForgotController::class))->name($name);
    //     Route::get($name = 'reset', sprintf('%s@showLinkRequestForm', \App\Http\Controllers\Auth\Password\ForgotController::class))->name('request');
    //     Route::get(sprintf('%s/{token}', $name), sprintf('%s@showResetForm', \App\Http\Controllers\Auth\Password\ResetController::class))->name($name);
    //     Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Auth\Password\ResetController::class, $name));
    // });

    /**
     * Customers
     */
    Route::prefix($prefix = 'customers')->name(sprintf('%s.', $prefix))->group(function () {
        Route::match(['post', 'get'], '/', \App\Http\Controllers\Customers\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Customers\CreateController::class)->name($name);
        Route::post($name = 'delete', sprintf('%s@deleteMultiple', \App\Http\Controllers\Customers\DeleteController::class))->name('deleteMultiple');

        Route::prefix('{customerId}')->group(function () {
            Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\Customers\UpdateController::class))->name($name);
            Route::post($name, sprintf('%s@update', \App\Http\Controllers\Customers\UpdateController::class));
            Route::post($name = 'delete', \App\Http\Controllers\Customers\DeleteController::class)->name($name);
            Route::post($name = 'restore', \App\Http\Controllers\Customers\RestoreController::class)->name($name);

            Route::prefix($prefix = 'tags')->name(sprintf('%s.', $prefix))->group(function () {
                Route::post($name = 'edit', \App\Http\Controllers\Customers\Tags\UpdateController::class)->name($name);
            });
        });

        Route::prefix($prefix = 'magazines')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = '/', \App\Http\Controllers\Customers\Magazines\IndexController::class)->name('index');
            Route::post($name = 'mail', \App\Http\Controllers\Customers\Magazines\MailController::class)->name($name);
            Route::post($name = 'event', \App\Http\Controllers\Customers\Magazines\EventController::class)->name($name);
        });        

        Route::prefix($prefix = 'postcards')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = 'export', \App\Http\Controllers\Customers\Postcards\ExportController::class)->name($name);
        });

        Route::prefix($prefix = 'files')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = 'import', sprintf('%s@view', \App\Http\Controllers\Customers\Files\ImportController::class))->name($name);
            Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Customers\Files\ImportController::class, $name));
        });
    });

    /**
     * Reservations
     */
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

    /**
     * Settings
     */
    Route::prefix($prefix = 'settings')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Settings\IndexController::class)->name('index');

        Route::prefix($prefix = 'company')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'edit', \App\Http\Controllers\Settings\Company\UpdateController::class)->name($name);
        });

        Route::prefix($prefix = 'profile')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'edit', \App\Http\Controllers\Settings\Profile\UpdateController::class)->name($name);
        });

        Route::prefix($prefix = 'store')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'edit', \App\Http\Controllers\Settings\Store\UpdateController::class)->name($name);
        });

        Route::prefix($prefix = 'printings')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get('/', sprintf('%s@view', \App\Http\Controllers\Settings\Printings\UpdateController::class))->name('index');

            Route::prefix('{settingId}')->group(function () {
                Route::post($name = 'edit', sprintf('%s@update', \App\Http\Controllers\Settings\Printings\UpdateController::class))->name($name);
            });
        });
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
     * Seats
     */
    Route::prefix($prefix = 'seats')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Seats\IndexController::class)->name('index');
        Route::post($name = 'add', \App\Http\Controllers\Seats\CreateController::class)->name($name);

        Route::prefix('{seatId}')->group(function () {
            Route::get($name = 'edit', sprintf('%s@view', \App\Http\Controllers\Seats\UpdateController::class))->name($name);
            Route::post($name, sprintf('%s@update', \App\Http\Controllers\Seats\UpdateController::class));
            Route::post($name = 'delete', \App\Http\Controllers\Seats\DeleteController::class)->name($name);
        });
    });

    /**
     * Users
     */
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
     * Print histories
     */
    Route::prefix($prefix = 'print_histories')->name(sprintf('%s.', $prefix))->group(function () {
        Route::post($name = 'delete', sprintf('%s@deleteMultiple', \App\Http\Controllers\PrintHistories\DeleteController::class))->name('deleteMultiple');

        Route::prefix('{printHistoryId}')->group(function () {
            Route::post($name = 'delete', \App\Http\Controllers\PrintHistories\DeleteController::class)->name($name);
        });
    });

    /**
     * Notifications
     */
    Route::prefix($prefix = 'notifications')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get($name = 'test', \App\Http\Controllers\Notifications\TestController::class)->name($name);
    });
    
    /**
     * Ajax
     */
    Route::prefix($prefix = 'ajax')->name(sprintf('%s.', $prefix))->group(function () {
        /**
         * Customers
         */
        Route::prefix($prefix = 'customers')->name(sprintf('%s.', $prefix))->group(function () {
            Route::match(['post', 'get'], 'list', sprintf('%s@listAjax', \App\Http\Controllers\Customers\IndexController::class));
        });

        /**
         * Customers
         */
        Route::prefix($prefix = 'reservations')->name(sprintf('%s.', $prefix))->group(function () {
            Route::match(['post', 'get'], 'list', sprintf('%s@listAjax', \App\Http\Controllers\Reservations\IndexController::class));
        });

        /**
         * Magazines
         */
        Route::prefix($prefix = 'magazines')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'image', \App\Http\Controllers\Customers\Magazines\ImageController::class)->name($name);
        });
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
