<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface UpdatableContract
{
    /**
     * @param  int $id
     * @param  array $args
     * @return  bool
     */
    public function update(int $id, array $args = []): bool;
}
