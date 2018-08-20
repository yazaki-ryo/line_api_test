<?php
declare(strict_types=1);

namespace App\Providers;

use Domain\Contracts\Cache\CacheableContract;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\ServiceProvider;

final class CacheServiceProvider extends ServiceProvider
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
        $this->app->bind(CacheableContract::class, function () {
            return new class implements CacheableContract
            {
                /**
                 * @param string $key
                 * @param int $minutes
                 * @param callable $callee
                 * @return mixed
                 */
                public function remember(string $key, int $minutes = 0, callable $callee = null)
                {
                    /** @var Repository $repository */
                    $repository = app(Repository::class);

                    return $repository->remember($key, $minutes, $callee);
                }
            };
        });
    }
}
