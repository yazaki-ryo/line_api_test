<?php
declare(strict_types=1);

namespace App\Services\Customers;

use App\Repositories\CustomerRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Customers\CreateCustomerInterface;
use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\GetCustomersInterface;
use Domain\Contracts\Customers\UpdateCustomerInterface;
use Domain\Models\Customer;

final class CustomersService implements
    GetCustomerInterface,
    GetCustomersInterface,
    CreateCustomerInterface,
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
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        return $this->repo->findAll($args);
    }

    /**
     * @param array $args
     * @return Customer
     */
    public function create(array $args = []): Customer
    {
        return $this->repo->create($args);
    }

    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool
    {
        return $this->repo->update($id, $args);
    }
}
