<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

final class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

}
