<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\Users\UsersService;
use App\Services\Companies\CompaniesService;
use Domain\Contracts\Companies\GetCompanyInterface;
use Domain\Contracts\Companies\UpdateCompanyInterface;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\GetUsersInterface;
use Domain\Contracts\Users\UpdateUserInterface;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        /**
         * Users
         */
        $this->app->bind(GetUserInterface::class, function () {
            return app(UsersService::class);
        });

        $this->app->bind(GetUsersInterface::class, function () {
            return app(UsersService::class);
        });

        $this->app->bind(UpdateUserInterface::class, function () {
            return app(UsersService::class);
        });

        /**
         * Companies
         */
        $this->app->bind(GetCompanyInterface::class, function () {
            return app(CompaniesService::class);
        });

        $this->app->bind(UpdateCompanyInterface::class, function () {
            return app(CompaniesService::class);
        });
    }
}
