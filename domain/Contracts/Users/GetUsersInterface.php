<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

use Illuminate\Support\Collection;

interface GetUsersInterface
{
    /**
     * @return Collection
     */
    public function findAll(): Collection;
}
