<?php
declare(strict_types=1);

namespace App\Traits\Cache;

use Domain\Contracts\Cache\CacheableContract;

trait Cacheable
{
    /**
     * @param string $key
     * @param int $minutes
     * @param callable $callee
     * @return mixed
     */
    public function remember(string $key, int $minutes = 0, callable $callee = null)
    {
        return app(CacheableContract::class)->remember($key, $minutes, $callee);
    }
}
