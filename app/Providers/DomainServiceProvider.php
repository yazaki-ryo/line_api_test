<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Views\Composers\PrefecturesComposer;
use App\Http\Views\Composers\SexesComposer;
use App\Services\CustomersService;
use App\Services\SexesService;
use App\Services\Pdf\PdfService;
use App\Services\FilesService;
use App\Services\PrefecturesService;
use App\Services\ReservationsService;
use App\Services\TagsService;
use App\Services\UsersService;
use App\Services\VisitedHistoriesService;
use Domain\UseCases\Customers\CreateCustomer;
use Domain\UseCases\Customers\DeleteCustomer;
use Domain\UseCases\Customers\Files\ImportFiles;
use Domain\UseCases\Customers\GetCustomers;
use Domain\UseCases\Customers\Postcards\ExportPostcards;
use Domain\UseCases\Customers\RestoreCustomer;
use Domain\UseCases\Customers\UpdateCustomer;
use Domain\UseCases\Customers\Tags\UpdateTags;
use Domain\UseCases\Reservations\GetReservations;
use Domain\UseCases\VisitedHistories\CreateVisitedHistory;
use Domain\UseCases\VisitedHistories\DeleteVisitedHistory;
use Domain\UseCases\VisitedHistories\UpdateVisitedHistory;
use Domain\UseCases\Tags\CreateTag;
use Domain\UseCases\Tags\DeleteTag;
use Domain\UseCases\Tags\GetTags;
use Domain\UseCases\Tags\UpdateTag;
use Domain\UseCases\Users\CreateUser;
use Domain\UseCases\Users\DeleteUser;
use Domain\UseCases\Users\GetUsers;
use Domain\UseCases\Users\RestoreUser;
use Domain\UseCases\Users\UpdateUser;
use Illuminate\Support\ServiceProvider;
use App\Services\StoresService;

final class DomainServiceProvider extends ServiceProvider
{
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
        /*
         |--------------------------------------------------------------------------
         | Usecases
         |--------------------------------------------------------------------------
         */

        /**
         * Customers
         */
        $this->app->bind(CreateCustomer::class, function () {
            return new CreateCustomer(
                app(StoresService::class)
            );
        });

        $this->app->bind(DeleteCustomer::class, function () {
            return new DeleteCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(GetCustomers::class, function () {
            return new GetCustomers(
                app(StoresService::class)// TODO
            );
        });

        $this->app->bind(ImportFiles::class, function () {
            return new ImportFiles(
                app(FilesService::class),
                app(CustomersService::class)
            );
        });

        $this->app->bind(ExportPostcards::class, function () {
            return new ExportPostcards(
                app(PdfService::class),
                app(StoresService::class)
            );
        });

        $this->app->bind(RestoreCustomer::class, function () {
            return new RestoreCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(UpdateCustomer::class, function () {
            return new UpdateCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(UpdateTags::class, function () {
            return new UpdateTags(
                app(CustomersService::class)
            );
        });

        /**
         * Reservations
         */
        $this->app->bind(GetReservations::class, function () {
            return new GetReservations(
                app(StoresService::class)
            );
        });

        $this->app->bind(UpdateReservation::class, function () {
            return new UpdateReservation(
                app(ReservationsService::class)
            );
        });

        /**
         * Visited Histories
         */
        $this->app->bind(CreateVisitedHistory::class, function () {
            return new CreateVisitedHistory(
                app(CustomersService::class)
            );
        });

        $this->app->bind(DeleteVisitedHistory::class, function () {
            return new DeleteVisitedHistory(
                app(VisitedHistoriesService::class)
            );
        });

        $this->app->bind(UpdateVisitedHistory::class, function () {
            return new UpdateVisitedHistory(
                app(VisitedHistoriesService::class)
            );
        });

        /**
         * Tags
         */
        $this->app->bind(CreateTag::class, function () {
            return new CreateTag(
                app(StoresService::class)
            );
        });

        $this->app->bind(DeleteTag::class, function () {
            return new DeleteTag(
                app(TagsService::class)
            );
        });

        $this->app->bind(GetTags::class, function () {
            return new GetTags(
                app(StoresService::class)
            );
        });

        $this->app->bind(UpdateTag::class, function () {
            return new UpdateTag(
                app(TagsService::class)
            );
        });

        /**
         * Users
         */
        $this->app->bind(CreateUser::class, function () {
            return new CreateUser(
                app(StoresService::class)
            );
        });

        $this->app->bind(DeleteUser::class, function () {
            return new DeleteUser(
                app(UsersService::class)
            );
        });

        $this->app->bind(GetUsers::class, function () {
            return new GetUsers(
                app(StoresService::class)// TODO
            );
        });

        $this->app->bind(RestoreUser::class, function () {
            return new RestoreUser(
                app(UsersService::class)
            );
        });

        $this->app->bind(UpdateUser::class, function () {
            return new UpdateUser(
                app(UsersService::class)
            );
        });


        /*
         |--------------------------------------------------------------------------
         | View Composers
         |--------------------------------------------------------------------------
         */
        $this->app->bind(PrefecturesComposer::class, function () {
            return new PrefecturesComposer(
                app(PrefecturesService::class)
            );
        });

        $this->app->bind(SexesComposer::class, function () {
            return new SexesComposer(
                app(SexesService::class)
            );
        });

    }
}
