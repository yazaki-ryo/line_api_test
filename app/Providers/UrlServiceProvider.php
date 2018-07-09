<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        /**
         * 特定の環境と条件でHttps接続を強制させる
         */
        if (true === env('SESSION_SECURE_COOKIE', false)) {
            \URL::forceScheme('https');
        }
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
