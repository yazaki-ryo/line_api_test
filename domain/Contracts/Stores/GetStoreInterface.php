<?php
declare(strict_types=1);

namespace Domain\Contracts\Stores;

use Domain\Models\Store;

interface GetStoreInterface
{
    /**
     * @param  int $id
     * @param  bool $trashed
     * @return Store|null
     */
    public function findById(int $id, bool $trashed = false): ?Store;
}
