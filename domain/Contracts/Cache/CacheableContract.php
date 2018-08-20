<?php
declare(strict_types=1);

namespace Domain\Contracts\Cache;

interface CacheableContract
{
    /**
     * @param string $key
     * @param int $minutes
     * @param callable $callee
     * @return mixed
     */
    public function remember(string $key, int $minutes = 0, callable $callee = null);
}
