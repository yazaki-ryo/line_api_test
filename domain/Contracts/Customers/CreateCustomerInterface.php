<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

use Domain\Models\Customer;

interface CreateCustomerInterface
{
    /**
     * @param array $args
     * @return Customer
     */
    public function create(array $args = []): Customer;
}
