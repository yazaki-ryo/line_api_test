<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

use App\Services\Collection\DomainCollection;

interface GetCustomersInterface
{
    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;
}
