<?php
declare(strict_types=1);

namespace App\Providers;

use App\Eloquents\EloquentCustomer;
use App\Eloquents\EloquentUser;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class RelationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        Relation::morphMap([
//             'customers' => EloquentCustomer::class,
            'users'     => EloquentUser::class,
        ]);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
