<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

use App\Services\Collection\DomainCollection;

interface GetCustomersInterface
{
    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection;
}
