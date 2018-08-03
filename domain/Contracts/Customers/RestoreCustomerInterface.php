<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

interface RestoreCustomerInterface
{
    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void;
}
