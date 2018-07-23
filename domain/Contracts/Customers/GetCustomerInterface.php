<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

use Domain\Models\Customer;

interface GetCustomerInterface
{
    /**
     * @param int $id
     * @return Customer|null
     */
    public function findById(int $id): ?Customer;
}
