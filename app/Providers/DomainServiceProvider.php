<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\GetUsersService;
use Domain\UseCases\Users\GetUsers;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->bind(GetUsers::class, function () {
            return new GetUsers(
                app(GetUsersService::class)
            );
        });

    }
}
