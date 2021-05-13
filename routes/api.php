<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @prefix api
 * @middleware api
 */

Route::post('schedule', sprintf('%s@post', \App\Http\Controllers\Api\ScheduleController::class))->name('schedule_post');
Route::get('schedule', sprintf('%s@get', \App\Http\Controllers\Api\ScheduleController::class))->name('schedule_get');