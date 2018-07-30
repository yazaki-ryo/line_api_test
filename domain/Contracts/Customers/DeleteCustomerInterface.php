<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

use Domain\Models\Customer;

interface DeleteCustomerInterface
{
    /**
     * @param int $id
     * @return Customer
     */
    public function delete(int $id): void;
}
