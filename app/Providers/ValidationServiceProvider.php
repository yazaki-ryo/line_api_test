<?php
declare(strict_types=1);

namespace App\Providers;

use Domain\Models\Customer;
use Domain\Models\Email;
use Domain\Models\PostalCode;
use Domain\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
use Lang;

final class ValidationServiceProvider extends ServiceProvider
{
    /**
     * @param Request $request
     * @return void
     */
    public function boot(Request $request): void
    {
        $this->extends($request);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @param Request $request
     * @return void
     */
    private function extends(Request $request): void
    {
        /** @var Factory $validator */
        $validator = $this->app->make('validator');

        $validator->extend('custom_alpha_dash', function ($attribute, $value) {
            return preg_match("/^[a-z0-9-]+$/i", $value) > 0;
        });

        $validator->extend('customer_id', function ($attribute, $value) use ($request) {
            return Customer::validateCustomerId($request->assign(), (int)$value);
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

        $validator->extend('store_id', function ($attribute, $value) use ($request) {
            return Store::validateStoreId($request->assign(), (int)$value);
        }, Lang::get('validation.invalid'));

        $validator->extend('zenkaku_katakana', function ($attribute, $value) {
            return preg_match("/[^ァ-ヶー]/u", $value) === 0;
        });
        
        $validator->extend('numeric_array', function ($attribute, $value) use ($request) {
            foreach($value as $v) {
                if(!is_numeric($v)) {
                    return false;
                }
            }
            return true;
        });
    }
}
