<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        /**
         * Bladeディレクティブ拡張
         */
        \Blade::directive('set', function(string $arg){
            list($key, $value) = explode(',', $arg);
            return "<?php $key = $value; ?>";
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
