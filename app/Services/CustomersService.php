<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\CustomerRepository;
use Domain\Contracts\Model\CreatableInterface;
use Domain\Contracts\Model\DeletableInterface;
use Domain\Contracts\Model\FindableInterface;
use Domain\Contracts\Model\RestorableInterface;
use Domain\Contracts\Model\UpdatableInterface;
use Domain\Models\Customer;

final class CustomersService implements
    CreatableInterface,
    DeletableInterface,
    FindableInterface,
    RestorableInterface,
    UpdatableInterface
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
     * @param bool $trashed
     * @return Customer|null
     */
    public function findById(int $id, bool $trashed = false): ?Customer
    {
        return $this->repo->findById($id, $trashed);
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
     * @param  int $id
     * @param  array $args
     * @return bool
     */
    public function update(int $id, array $args = [])
    {
        return $this->repo->update($id, $args);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->repo->delete($id);
    }

    /**
     * @param bool $trashed
     * @return void
     */
    public function restore(int $id): void
    {
        $this->repo->restore($id);
    }

}
