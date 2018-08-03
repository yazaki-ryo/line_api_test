<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        //
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Support\Providers\EventServiceProvider::register()
     */
    public function register(): void
    {
        //
    }

}
