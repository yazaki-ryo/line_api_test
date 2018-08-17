<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\CustomersService;
use App\Services\PdfService;
use Domain\Adapters\Customers\UpdateCustomerAdapter;
use Domain\Contracts\Database\TransactionableContract;
use Domain\UseCases\Customers\CreateCustomer;
use Domain\UseCases\Customers\DeleteCustomer;
use Domain\UseCases\Customers\GetCustomers;
use Domain\UseCases\Customers\OutputPdf;
use Domain\UseCases\Customers\GetCustomer;
use Domain\UseCases\Customers\RestoreCustomer;
use Domain\UseCases\Customers\UpdateCustomer;
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
         * Customers
         */
        $this->app->bind(CreateCustomer::class, function () {
            return new CreateCustomer(
                app(CustomersService::class),
                app(TransactionableContract::class)
            );
        });

        $this->app->bind(DeleteCustomer::class, function () {
            return new DeleteCustomer(
                app(CustomersService::class),
                app(TransactionableContract::class)
            );
        });

        $this->app->bind(GetCustomer::class, function () {
            return new GetCustomer(
                app(CustomersService::class)
            );
        });

        $this->app->bind(GetCustomers::class, function () {
            return new GetCustomers(app(CustomersService::class));
        });

        $this->app->bind(OutputPdf::class, function () {
            return new OutputPdf(
                app(PdfService::class),
                app(CustomersService::class)
            );
        });

        $this->app->bind(RestoreCustomer::class, function () {
            return new RestoreCustomer(
                app(CustomersService::class),
                app(TransactionableContract::class)
            );
        });

        $this->app->bind(UpdateCustomer::class, function () {
            return new UpdateCustomer(
                app(CustomersService::class),
                app(UpdateCustomerAdapter::class)
//                 app(TransactionableContract::class)
            );
        });

    }
}
