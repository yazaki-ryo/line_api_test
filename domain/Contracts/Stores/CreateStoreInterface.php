<?php
declare(strict_types=1);

namespace Domain\Contracts\Stores;

use Domain\Models\Store;

interface CreateStoreInterface
{
    /**
     * @param array $args
     * @return Store
     */
    public function create(array $args = []): Store;
}
