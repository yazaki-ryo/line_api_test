<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class BladeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        \Blade::directive('set', function(string $arg){
            list($key, $value) = explode(',', $arg);
            return sprintf('<?php %s = %s; ?>', $key, $value);
        });

        \Blade::if('env', function ($env) {
            return app()->environment($env);
        });
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }
}
