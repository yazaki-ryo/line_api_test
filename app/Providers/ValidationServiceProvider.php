<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\UserRepository;
use Domain\Models\Customer;
use Domain\Models\Email;
use Domain\Models\PostalCode;
use Domain\Models\Store;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
use Lang;

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

        $validator->extend('custom_alpha_dash', function ($attribute, $value) {
            return preg_match("/^[a-z0-9-]+$/i", $value) > 0;
        });

        $validator->extend('customer_id', function ($attribute, $value) use ($auth) {
            return Customer::validateCustomerId(UserRepository::toModel($auth->user()), (int)$value);
        }, Lang::get('validation.invalid'));

        $validator->extend('email', function ($attribute, $value) {
            return Email::validate($value);
        });

        $validator->extend('invalid', function ($attribute, $value) {
            return false;
        });

        $validator->extend('postal_code', function ($attribute, $value) {
            return PostalCode::validate($value);
        }, Lang::get('validation.format'));

        $validator->extend('store_id', function ($attribute, $value) use ($auth) {
            return Store::validateStoreId(UserRepository::toModel($auth->user()), (int)$value);
        }, Lang::get('validation.invalid'));

        $validator->extend('zenkaku_katakana', function ($attribute, $value) {
            return preg_match("/[^ァ-ヶー]/u", $value) === 0;
        });
}

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
