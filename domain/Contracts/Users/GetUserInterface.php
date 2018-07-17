<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

use Domain\Models\User;

interface GetUserInterface
{
    /**
     * @return User
     */
    public function findById(int $id): User;
}
