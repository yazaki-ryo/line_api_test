<?php
declare(strict_types=1);

namespace Domain\Contracts\Customers;

interface UpdateCustomerInterface
{
    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool;
}
