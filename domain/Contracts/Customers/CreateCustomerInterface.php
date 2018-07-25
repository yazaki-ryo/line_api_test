<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

use Domain\Models\Customer;

interface CreateCustomerInterface
{
    /**
     * @param array $attributes
     * @return Customer
     */
    public function create(array $attributes = []): Customer;
}
