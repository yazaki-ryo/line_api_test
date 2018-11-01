<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class BladeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        /**
         * @param string|array $env
         * @return bool
         */
        \Blade::if('env', function ($env) {
            return app()->environment($env);
        });
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
