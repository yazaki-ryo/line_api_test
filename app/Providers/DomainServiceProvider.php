<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\UsersService;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\GetUsersInterface;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->bind(GetUserInterface::class, function () {
            return app(UsersService::class);
        });

        $this->app->bind(GetUsersInterface::class, function () {
            return app(UsersService::class);
        });

    }
}
