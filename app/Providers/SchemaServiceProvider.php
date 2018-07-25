<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class SchemaServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        /**
         * utf8mb4_general_ciへの対応
         */
        \Schema::defaultStringLength(191);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
