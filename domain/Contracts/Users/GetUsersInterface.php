<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

use App\Services\Collection\DomainCollection;

interface GetUsersInterface
{
    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;
}
