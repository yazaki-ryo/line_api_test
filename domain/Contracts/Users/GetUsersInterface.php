<?php
declare(strict_types=1);

namespace Domain\Contracts\Users;

use App\Services\Collection\DomainCollection;

interface GetUsersInterface
{
    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection;
}
