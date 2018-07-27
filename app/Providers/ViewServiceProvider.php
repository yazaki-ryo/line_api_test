<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Views\Composers\PrefecturesComposer;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        View::creator('config/company', PrefecturesComposer::class);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
