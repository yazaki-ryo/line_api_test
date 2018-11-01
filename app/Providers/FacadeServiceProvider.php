<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\UtilitiesService;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('utility', UtilitiesService::class);
    }

}
