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
 *
 * prefix: /
 * middleware: web
 */

$router->group([
    //
], function(Router $router) {
    $router->view('/', 'welcome');
    $router->get('home', \App\Http\Controllers\HomeController::class)->name('home');

    // Authentication Routes...
    $router->get( 'login',  \App\Http\Controllers\Auth\LoginController::class . '@showLoginForm')->name('login');
    $router->post('login',  \App\Http\Controllers\Auth\LoginController::class . '@login');
    $router->post('logout', \App\Http\Controllers\Auth\LoginController::class . '@logout')->name('logout');

    // Registration Routes...
    $router->get( 'register', \App\Http\Controllers\Auth\RegisterController::class . '@showRegistrationForm')->name('register');
    $router->post('register', \App\Http\Controllers\Auth\RegisterController::class . '@register');

    // Password Reset Routes...
    $router->group([
        'prefix' => $prefix = 'password',
    ], function (Router $router) use ($prefix) {
        $router->get( 'reset',         \App\Http\Controllers\Auth\Password\ForgotController::class . '@showLinkRequestForm')->name("{$prefix}.request");
        $router->post('email',         \App\Http\Controllers\Auth\Password\ForgotController::class . '@sendResetLinkEmail')->name("{$prefix}.email");
        $router->get( 'reset/{token}', \App\Http\Controllers\Auth\Password\ResetController::class . '@showResetForm')->name("{$prefix}.reset");
        $router->post('reset',         \App\Http\Controllers\Auth\Password\ResetController::class . '@reset');
    });

});
