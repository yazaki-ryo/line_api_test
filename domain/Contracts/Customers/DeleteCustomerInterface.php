<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

interface DeleteCustomerInterface
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
