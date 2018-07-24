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
     * Customers
     */
    $router->group([
        'prefix' => $prefix = 'customers',
    ], function (Router $router) use ($prefix) {
        $router->get( '/', \App\Http\Controllers\Customers\IndexController::class)->name(sprintf('%s.index', $prefix));
        $router->get( '{customerId}/edit', \App\Http\Controllers\Customers\UpdateController::class . '@view')->name(sprintf('%s.edit', $prefix));
        $router->post('{customerId}/edit', \App\Http\Controllers\Customers\UpdateController::class . '@excute');
    });

    /**
     * Authentication
     */
    $router->get( 'login',  \App\Http\Controllers\Auth\LoginController::class . '@showLoginForm')->name('login');
    $router->post('login',  \App\Http\Controllers\Auth\LoginController::class . '@login');
    $router->post('logout', \App\Http\Controllers\Auth\LoginController::class . '@logout')->name('logout');

    /**
     * Registration
     */
    $router->get( 'register', \App\Http\Controllers\Auth\RegisterController::class . '@showRegistrationForm')->name('register');
    $router->post('register', \App\Http\Controllers\Auth\RegisterController::class . '@register');

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
     * Users
     */
    $router->group([
        'prefix' => $prefix = 'users',
    ], function (Router $router) use ($prefix) {
        $router->get( '/', \App\Http\Controllers\Users\IndexController::class)->name(sprintf('%s.index', $prefix));
    });

    /**
     * Configuration
     */
    $router->group([
        'prefix' => $prefix = 'config',
    ], function (Router $router) use ($prefix) {
        $router->get( 'profile', \App\Http\Controllers\Config\ProfileController::class . '@view')->name(sprintf('%s.profile', $prefix));
        $router->post('profile', \App\Http\Controllers\Config\ProfileController::class . '@excute');
        $router->get( 'company', \App\Http\Controllers\Config\CompanyController::class . '@view')->name(sprintf('%s.company', $prefix));
        $router->post('company', \App\Http\Controllers\Config\CompanyController::class . '@excute');
    });

});
