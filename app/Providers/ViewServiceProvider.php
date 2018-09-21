<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Views\Composers\AuthComposer;
use App\Http\Views\Composers\NotificationsComposer;
use App\Http\Views\Composers\PrefecturesComposer;
use App\Http\Views\Composers\PrintSettingsComposer;
use App\Http\Views\Composers\SexesComposer;
use App\Http\Views\Composers\StoresComposer;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(Router $router): void
    {
        View::creator([
            '*',
        ], AuthComposer::class);

        View::creator([
            'layouts.app',
        ], NotificationsComposer::class);

        View::creator([
            'settings.company',
            'settings.store',
            'customers.add',
            'customers.edit',
        ], PrefecturesComposer::class);

        View::creator([
            'settings.printings.edit',
        ], PrintSettingsComposer::class);

        View::creator([
            'customers.add',
            'customers.edit',
        ], SexesComposer::class);

        View::creator([
            'customers.*',
        ], StoresComposer::class);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
