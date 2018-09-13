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
use Domain\UseCases\Customers\CreateCustomer;
use Domain\UseCases\Customers\DeleteCustomer;
use Domain\UseCases\Customers\Files\ImportFiles;
use Domain\UseCases\Customers\GetCustomer;
use Domain\UseCases\Customers\GetCustomers;
use Domain\UseCases\Customers\Postcards\ExportPostcards;
use Domain\UseCases\Customers\RestoreCustomer;
use Domain\UseCases\Customers\UpdateCustomer;
use Domain\UseCases\Customers\VisitedHistories\CreateVisitedHistory;
use Domain\UseCases\Customers\VisitedHistories\DeleteVisitedHistory;
use Domain\UseCases\Customers\VisitedHistories\UpdateVisitedHistory;
use Illuminate\Support\ServiceProvider;

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
        /**
         * Usecases
         */
        $this->app->bind(CreateCustomer::class, function () {
            return new CreateCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(DeleteCustomer::class, function () {
            return new DeleteCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(GetCustomer::class, function () {
            return new GetCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(GetCustomers::class, function () {
            return new GetCustomers(
                app(CustomersService::class)
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
                app(CustomersService::class)
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

        $this->app->bind(CreateVisitedHistory::class, function () {
            return new CreateVisitedHistory(
                app(CustomersService::class)
            );
        });

        $this->app->bind(DeleteVisitedHistory::class, function () {
            return new DeleteVisitedHistory(
                app(CustomersService::class)
            );
        });

        $this->app->bind(UpdateVisitedHistory::class, function () {
            return new UpdateVisitedHistory(
                app(CustomersService::class)
            );
        });


        /**
         * View Composers
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
