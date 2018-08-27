<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\UserRepository;
use Domain\Models\Customer;
use Domain\Models\Email;
use Domain\Models\Store;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;

final class ValidationServiceProvider extends ServiceProvider
{
    /**
     * @param Auth $auth
     * @return void
     */
    public function boot(Auth $auth): void
    {
        /** @var Factory $validator */
        $validator = $this->app->make('validator');

        $validator->extend('email', function ($attribute, $value) {
            return Email::validate($value);
        }, null);// override

        $validator->extend('store_id', function ($attribute, $value) use ($auth) {
            return Store::validateStoreId(UserRepository::toModel($auth->user()), (int)$value);
        }, __('The value sent is invalid.'));

        $validator->extend('customer_id', function ($attribute, $value) use ($auth) {
            return Customer::validateCustomerId(UserRepository::toModel($auth->user()), (int)$value);
        }, __('The value sent is invalid.'));

        $validator->extend('customer_ids_from_csv_string_for_output_postcards', function ($attribute, $value) use ($auth) {
            return Customer::validateCustomerIdsFromCsvStringForOutputPostcards(UserRepository::toModel($auth->user()), $value);
        }, __('The value sent is invalid.'));
}

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
