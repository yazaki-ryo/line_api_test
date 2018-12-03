<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

final class SchemaServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->defaultStringLength();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    private function defaultStringLength(): void
    {
        /**
         * For utf8mb4_general_ci collation.
         */
        Schema::defaultStringLength(191);
    }
}
