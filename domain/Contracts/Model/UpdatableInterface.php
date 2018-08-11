<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface UpdatableInterface
{
    /**
     * @param  int $id
     * @param  array $args
     */
    public function update(int $id, array $args = []);
}
