<?php
declare(strict_types=1);

namespace Domain\Contracts\Stores;

use Domain\Models\Store;

interface GetStoreInterface
{
    /**
     * @param int $id
     * @return Store|null
     */
    public function findById(int $id): ?Store;
}
