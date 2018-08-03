<?php
declare(strict_types=1);

namespace Domain\Contracts\Stores;

use App\Services\Collection\DomainCollection;

interface GetStoresInterface
{
    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;
}
