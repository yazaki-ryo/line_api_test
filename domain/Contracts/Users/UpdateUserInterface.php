<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

interface UpdateUserInterface
{
    /**
     * @param  array $args
     * @param  int|null $id
     * @return bool
     */
    public function update(array $args = [], int $id = null);
}
