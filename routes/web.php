<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

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
 * @var Router $router
 * @prefix /
 * @middleware web
 */
$router->group([
    //
], function (Router $router) {
    $router->get('/', \App\Http\Controllers\HomeController::class)->name('home');

    /**
     * Authentication
     */
    $router->get( 'login',  \App\Http\Controllers\Auth\LoginController::class . '@showLoginForm')->name('login');
    $router->post('login',  \App\Http\Controllers\Auth\LoginController::class . '@login');
    $router->post('logout', \App\Http\Controllers\Auth\LoginController::class . '@logout')->name('logout');

    /**
     * Registration
     */
//     $router->get( 'register', \App\Http\Controllers\Auth\RegisterController::class . '@showRegistrationForm')->name('register');
//     $router->post('register', \App\Http\Controllers\Auth\RegisterController::class . '@register');

    /**
     * Password Reset
     */
    $router->group([
        'prefix' => $prefix = 'password',
    ], function (Router $router) use ($prefix) {
        $router->get( 'reset',         \App\Http\Controllers\Auth\Password\ForgotController::class . '@showLinkRequestForm')->name(sprintf('%s.request', $prefix));
        $router->post('email',         \App\Http\Controllers\Auth\Password\ForgotController::class . '@sendResetLinkEmail')->name(sprintf('%s.email', $prefix));
        $router->get( 'reset/{token}', \App\Http\Controllers\Auth\Password\ResetController::class . '@showResetForm')->name(sprintf('%s.reset', $prefix));
        $router->post('reset',         \App\Http\Controllers\Auth\Password\ResetController::class . '@reset');
    });

    /**
     * Customers
     */
    $router->group([
        'prefix' => $prefix = 'customers',
    ], function (Router $router) use ($prefix) {
        $router->get( '/', \App\Http\Controllers\Customers\IndexController::class)->name($prefix);
        $router->get( 'add', \App\Http\Controllers\Customers\CreateController::class . '@view')->name(sprintf('%s.add', $prefix));
        $router->post('add', \App\Http\Controllers\Customers\CreateController::class . '@create');

        $router->group([
            'prefix' => '{customerId}',
        ], function (Router $router) use ($prefix) {
            $router->get( 'edit', \App\Http\Controllers\Customers\UpdateController::class . '@view')->name(sprintf('%s.edit', $prefix));
            $router->post('edit', \App\Http\Controllers\Customers\UpdateController::class . '@update');
            $router->post('delete', \App\Http\Controllers\Customers\DeleteController::class)->name(sprintf('%s.delete', $prefix));
            $router->post('restore', \App\Http\Controllers\Customers\RestoreController::class)->name(sprintf('%s.restore', $prefix));

            $router->group([
                'prefix' => $prefix2 = 'visited_histories',
            ], function (Router $router) use ($prefix, $prefix2) {
                $router->get( 'add', \App\Http\Controllers\Customers\VisitedHistories\CreateController::class . '@view')->name(sprintf('%s.%s.add', $prefix, $prefix2));
                $router->post('add', \App\Http\Controllers\Customers\VisitedHistories\CreateController::class . '@create');

                $router->group([
                    'prefix' => '{visitedHistoryId}',
                ], function (Router $router) use ($prefix, $prefix2) {
                    $router->get( 'edit', \App\Http\Controllers\Customers\VisitedHistories\UpdateController::class . '@view')->name(sprintf('%s.%s.edit', $prefix, $prefix2));
                    $router->post('edit', \App\Http\Controllers\Customers\VisitedHistories\UpdateController::class . '@update');
                    $router->post('delete', \App\Http\Controllers\Customers\VisitedHistories\DeleteController::class)->name(sprintf('%s.%s.delete', $prefix, $prefix2));
                });
            });
        });

        $router->group([
            'prefix' => $prefix2 = 'postcards',
        ], function (Router $router) use ($prefix, $prefix2) {
            $router->post( 'export', \App\Http\Controllers\Customers\Postcards\ExportController::class)->name(sprintf('%s.%s.export', $prefix, $prefix2));
        });

        $router->group([
            'prefix' => $prefix2 = 'files',
        ], function (Router $router) use ($prefix, $prefix2) {
            $router->get( 'import', \App\Http\Controllers\Customers\Files\ImportController::class . '@view')->name(sprintf('%s.%s.import', $prefix, $prefix2));
            $router->post('import', \App\Http\Controllers\Customers\Files\ImportController::class . '@import');
        });
    });

    /**
     * Users
     */
    $router->group([
        'prefix' => $prefix = 'users',
    ], function (Router $router) use ($prefix) {

    });

    /**
     * Settings
     */
    $router->group([
        'prefix' => $prefix = 'settings',
    ], function (Router $router) use ($prefix) {
        $router->get( 'company', \App\Http\Controllers\Settings\Company\UpdateController::class . '@view')->name(sprintf('%s.company', $prefix));
        $router->post('company', \App\Http\Controllers\Settings\Company\UpdateController::class . '@update');
        $router->get( 'profile', \App\Http\Controllers\Settings\Profile\UpdateController::class . '@view')->name(sprintf('%s.profile', $prefix));
        $router->post('profile', \App\Http\Controllers\Settings\Profile\UpdateController::class . '@update');
        $router->get( 'store', \App\Http\Controllers\Settings\Store\UpdateController::class . '@view')->name(sprintf('%s.store', $prefix));
        $router->post('store', \App\Http\Controllers\Settings\Store\UpdateController::class . '@update');
        $router->get( 'printings', \App\Http\Controllers\Settings\Printings\UpdateController::class . '@view')->name(sprintf('%s.printings', $prefix));
        $router->post('printings/{settingId}', \App\Http\Controllers\Settings\Printings\UpdateController::class . '@update')->name(sprintf('%s.printings.update', $prefix));
    });

    /**
     * Notifications
     */
    $router->group([
        'prefix' => $prefix = 'notifications',
    ], function (Router $router) use ($prefix) {
        $router->get( 'test', \App\Http\Controllers\Notifications\TestController::class)->name(sprintf('%s.test', $prefix));
    });

});
