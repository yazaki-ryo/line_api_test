<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

final class LocalServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $providers = [
        \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        \Barryvdh\Debugbar\ServiceProvider::class,
//         \Laravel\Dusk\DuskServiceProvider::class,
        \NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $aliases = [
        //
    ];

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
        if ($this->app->isLocal()) {
            $this->registerProviders();
            $this->registerAliases();
        }
    }

    /**
     * @return void
     */
    protected function registerProviders(): void
    {
        if (count($this->providers)) {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * @return void
     */
    protected function registerAliases(): void
    {
        if (count($this->aliases)) {
            $loader = AliasLoader::getInstance();

            foreach ($this->aliases as $alias => $facade) {
                $loader->alias($alias, $facade);
            }
        }
    }

}
