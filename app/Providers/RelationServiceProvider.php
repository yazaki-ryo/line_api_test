<?php
declare(strict_types=1);

namespace App\Providers;

use App\Eloquents\EloquentCustomer;
use App\Eloquents\EloquentUser;
use App\Eloquents\EloquentVisitedHistory;
use App\Eloquents\EloquentPrintHistory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class RelationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->morphMap();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    private function morphMap(): void
    {
        Relation::morphMap([
            'customers' => EloquentCustomer::class,
            'users'     => EloquentUser::class,
            'visited_histories' => EloquentVisitedHistory::class,
            'mail_histories' => EloquentMailHistory::class,
            'print_histories' => EloquentPrintHistory::class,
        ]);
    }
}
