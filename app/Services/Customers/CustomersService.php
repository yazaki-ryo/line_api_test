<?php
declare(strict_types=1);

namespace App\Services\Customers;

use App\Repositories\CustomerRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\GetCustomersInterface;
use Domain\Contracts\Customers\UpdateCustomerInterface;
use Domain\Models\Customer;

final class CustomersService implements
    GetCustomerInterface,
    GetCustomersInterface,
    UpdateCustomerInterface
{
    /** @var CustomerRepository */
    private $repo;

    /**
     * @param CustomerRepository $repo
     */
    public function __construct(CustomerRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param int $id
     * @return Customer|null
     */
    public function findById(int $id): ?Customer
    {
        return $this->repo->findById($id);
    }

    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        return $this->repo->findAll();
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes = []): bool
    {
        return $this->repo->update($id, $attributes);
    }
}
