<?php
declare(strict_types=1);

namespace Domain\Contracts\Stores;

interface UpdateStoreInterface
{
    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool;
}
