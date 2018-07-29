<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

interface UpdateUserInterface
{
    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool;
}
