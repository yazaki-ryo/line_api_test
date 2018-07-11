<?php
declare(strict_types=1);

namespace App\Providers;

use Domain\UseCases\GetUser;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->bind(GetUser::class, function () {
//             $adapter = app(GetAccountAdapter::class);

            return new GetUser(/*$adapter*/);
        });

    }
}
