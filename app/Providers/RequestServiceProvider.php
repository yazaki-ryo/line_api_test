<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\EloquentRepository;
use Domain\Models\DomainModel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

final class RequestServiceProvider extends ServiceProvider
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
        $this->registerAssign();
    }

    /**
     * @return void
     */
    private function registerAssign()
    {
        /**
         * @param string|null  $guard
         * @return DomainModel|null
         */
        Request::macro('assign', function (?string $guard = null): ?DomainModel {
            return is_null($user = $this->user($guard)) ? null : EloquentRepository::assign($user, true);
        });
    }
}
