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
