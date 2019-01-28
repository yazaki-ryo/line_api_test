<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Views\Composers;
use App\Services;
use Domain\UseCases\Customers;
use Domain\UseCases\Reservations;
use Domain\UseCases\Settings;
use Domain\UseCases\Tags;
use Domain\UseCases\Users;
use Domain\UseCases\VisitedHistories;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerUsecases();
        $this->registerViewComposers();
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::provides()
     * @return array
     */
    public function provides(): array
    {
        return [
            Customers\CreateCustomer::class,
            Customers\DeleteCustomer::class,
            Customers\GetCustomers::class,
//             Customers\Files\ImportFiles::class,
            Customers\Postcards\ExportPostcards::class,
            Customers\RestoreCustomer::class,
            Customers\UpdateCustomer::class,
            Customers\Tags\UpdateTags::class,

            Reservations\CreateReservation::class,
            Reservations\DeleteReservation::class,
            Reservations\GetReservations::class,
            Reservations\UpdateReservation::class,
            Reservations\VisitedHistories\CreateVisitedHistory::class,

            Settings\UpdateStore::class,

            Tags\CreateTag::class,
            Tags\DeleteTag::class,
            Tags\GetTags::class,
            Tags\UpdateTag::class,

            Users\CreateUser::class,
            Users\DeleteUser::class,
            Users\GetUsers::class,
            Users\RestoreUser::class,
            Users\UpdateUser::class,

            VisitedHistories\CreateVisitedHistory::class,
            VisitedHistories\DeleteVisitedHistory::class,
            VisitedHistories\UpdateVisitedHistory::class,

            Composers\PrefecturesComposer::class,
            Composers\SexesComposer::class,
        ];
    }

    /**
     * @return void
     */
    private function registerUsecases(): void
    {
        /**
         * Customers
         */
        $this->app->singleton(Customers\CreateCustomer::class, function () {
            return new Customers\CreateCustomer(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Customers\DeleteCustomer::class, function () {
            return new Customers\DeleteCustomer(
                app(Services\CustomersService::class)
            );
        });

        $this->app->singleton(Customers\GetCustomers::class, function () {
            return new Customers\GetCustomers(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Customers\Files\ImportFiles::class, function () {
            return new Customers\Files\ImportFiles(
                app(Services\FilesService::class),
                app(Services\CustomersService::class)
            );
        });

        $this->app->singleton(Customers\Postcards\ExportPostcards::class, function () {
            return new Customers\Postcards\ExportPostcards(
                app(Services\Pdf\PdfService::class),
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Customers\RestoreCustomer::class, function () {
            return new Customers\RestoreCustomer(
                app(Services\CustomersService::class)
            );
        });

        $this->app->singleton(Customers\UpdateCustomer::class, function () {
            return new Customers\UpdateCustomer(
                app(Services\CustomersService::class)
            );
        });

        $this->app->singleton(Customers\Tags\UpdateTags::class, function () {
            return new Customers\Tags\UpdateTags(
                app(Services\CustomersService::class)
            );
        });

        /**
         * Reservations
         */
        $this->app->singleton(Reservations\CreateReservation::class, function () {
            return new Reservations\CreateReservation(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Reservations\DeleteReservation::class, function () {
            return new Reservations\DeleteReservation(
                app(Services\ReservationsService::class)
            );
        });

        $this->app->singleton(Reservations\GetReservations::class, function () {
            return new Reservations\GetReservations(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Reservations\UpdateReservation::class, function () {
            return new Reservations\UpdateReservation(
                app(Services\ReservationsService::class)
            );
        });

        $this->app->singleton(Reservations\VisitedHistories\CreateVisitedHistory::class, function () {
            return new Reservations\VisitedHistories\CreateVisitedHistory(
                app(Services\ReservationsService::class)
            );
        });

        /**
         * Settings
         */
        $this->app->singleton(Settings\UpdateStore::class, function () {
            return new Settings\UpdateStore(
                app(Services\StoresService::class)
            );
        });

        /**
         * Tags
         */
        $this->app->singleton(Tags\CreateTag::class, function () {
            return new Tags\CreateTag(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Tags\DeleteTag::class, function () {
            return new Tags\DeleteTag(
                app(Services\TagsService::class)
            );
        });

        $this->app->singleton(Tags\GetTags::class, function () {
            return new Tags\GetTags(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Tags\UpdateTag::class, function () {
            return new Tags\UpdateTag(
                app(Services\TagsService::class)
            );
        });

        /**
         * Users
         */
        $this->app->singleton(Users\CreateUser::class, function () {
            return new Users\CreateUser(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Users\DeleteUser::class, function () {
            return new Users\DeleteUser(
                app(Services\UsersService::class)
            );
        });

        $this->app->singleton(Users\GetUsers::class, function () {
            return new Users\GetUsers(
                app(Services\StoresService::class)
            );
        });

        $this->app->singleton(Users\RestoreUser::class, function () {
            return new Users\RestoreUser(
                app(Services\UsersService::class)
            );
        });

        $this->app->singleton(Users\UpdateUser::class, function () {
            return new Users\UpdateUser(
                app(Services\UsersService::class)
            );
        });

        /**
         * Visited Histories
         */
        $this->app->singleton(VisitedHistories\CreateVisitedHistory::class, function () {
            return new VisitedHistories\CreateVisitedHistory(
                app(Services\CustomersService::class)
            );
        });

        $this->app->singleton(VisitedHistories\DeleteVisitedHistory::class, function () {
            return new VisitedHistories\DeleteVisitedHistory(
                app(Services\VisitedHistoriesService::class)
            );
        });

        $this->app->singleton(VisitedHistories\UpdateVisitedHistory::class, function () {
            return new VisitedHistories\UpdateVisitedHistory(
                app(Services\VisitedHistoriesService::class),
                app(FilesystemFactory::class)
            );
        });
    }

    /**
     * @return void
     */
    private function registerViewComposers(): void
    {
        $this->app->singleton(Composers\PrefecturesComposer::class, function () {
            return new Composers\PrefecturesComposer(
                app(Services\PrefecturesService::class)
            );
        });

        $this->app->singleton(Composers\SexesComposer::class, function () {
            return new Composers\SexesComposer(
                app(Services\SexesService::class)
            );
        });
    }
}
