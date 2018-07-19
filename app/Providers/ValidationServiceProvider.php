<?php
declare(strict_types=1);

namespace App\Providers;

use Domain\Models\Email;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;

final class ValidationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        /** @var Factory $validator */
        $validator = $this->app->make('validator');

        $validator->extend('email', function ($attribute, $value) {
            return Email::validate($value);
        }, null);// override
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
