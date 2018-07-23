<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\Companies\CompaniesService;
use App\Services\Customers\CustomersService;
use App\Services\Prefectures\PrefecturesService;
use App\Services\Users\UsersService;
use Domain\Contracts\Companies\GetCompanyInterface;
use Domain\Contracts\Companies\GetCompaniesInterface;
use Domain\Contracts\Companies\UpdateCompanyInterface;
use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\GetCustomersInterface;
use Domain\Contracts\Customers\UpdateCustomerInterface;
use Domain\Contracts\Prefectures\GetPrefectureInterface;
use Domain\Contracts\Prefectures\GetPrefecturesInterface;
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
         * Companies
         */
        $this->app->bind(GetCompanyInterface::class, function () {
            return app(CompaniesService::class);
        });

        $this->app->bind(GetCompaniesInterface::class, function () {
            return app(CompaniesService::class);
        });

        $this->app->bind(UpdateCompanyInterface::class, function () {
            return app(CompaniesService::class);
        });

        /**
         * Customers
         */
        $this->app->bind(GetCustomerInterface::class, function () {
            return app(CustomersService::class);
        });

        $this->app->bind(GetCustomersInterface::class, function () {
            return app(CustomersService::class);
        });

        $this->app->bind(UpdateCustomerInterface::class, function () {
            return app(CustomersService::class);
        });

        /**
         * Prefectures
         */
        $this->app->bind(GetPrefectureInterface::class, function () {
            return app(PrefecturesService::class);
        });

        $this->app->bind(GetPrefecturesInterface::class, function () {
            return app(PrefecturesService::class);
        });

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

    }
}
