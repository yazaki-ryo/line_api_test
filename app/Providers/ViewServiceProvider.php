<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Views\Composers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->viewCreators();
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
    private function viewCreators(): void
    {
        View::creator([
            '*',
        ], Composers\AuthComposer::class);

        View::creator([
            'layouts.app',
        ], Composers\NotificationsComposer::class);

        View::creator([
            'settings.index',
            'customers.index',
            'customers.edit',
        ], Composers\PrefecturesComposer::class);

        View::creator([
            'customers.edit',
            'visited_histories.edit',
            'visited_histories.components.list',
        ], Composers\SeatsComposer::class);

        View::creator([
            'settings.printings.index',
        ], Composers\PrintSettingsComposer::class);

        View::creator([
            'customers.index',
            'customers.edit',
        ], Composers\SexesComposer::class);

        View::creator([
            'layouts.app',
            'tags.edit',
            'users.edit',
        ], Composers\StoresComposer::class);
    }
}
