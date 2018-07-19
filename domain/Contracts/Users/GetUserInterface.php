<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

use Domain\Models\User;

interface GetUserInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;
}
