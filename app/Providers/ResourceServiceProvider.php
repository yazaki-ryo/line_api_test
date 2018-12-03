<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\ServiceProvider;

final class ResourceServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->withoutWrapping();
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
    private function withoutWrapping(): void
    {
        Resource::withoutWrapping();
    }
}
