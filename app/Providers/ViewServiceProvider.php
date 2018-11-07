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
            'tags.add',
            'tags.edit',
            'users.add',
            'users.edit',
        ], StoresComposer::class);

        View::creator([
            'layouts.app',
        ], NotificationsComposer::class);

        View::creator([
            'settings.index',
            'customers.index',
            'customers.edit',
        ], PrefecturesComposer::class);

        View::creator([
            'settings.printings.index',
        ], PrintSettingsComposer::class);

        View::creator([
            'customers.index',
            'customers.edit',
        ], SexesComposer::class);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
