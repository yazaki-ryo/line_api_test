<?php
declare(strict_types=1);

namespace App\Providers;

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
            return Store::validateStoreId($auth, (int)$value);
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
