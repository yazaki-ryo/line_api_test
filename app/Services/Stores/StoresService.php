<?php
declare(strict_types=1);

namespace App\Services\Stores;

use App\Repositories\StoreRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Stores\CreateStoreInterface;
use Domain\Contracts\Stores\GetStoreInterface;
use Domain\Contracts\Stores\GetStoresInterface;
use Domain\Contracts\Stores\UpdateStoreInterface;
use Domain\Models\Store;

final class StoresService implements
    CreateStoreInterface,
    GetStoreInterface,
    GetStoresInterface,
    UpdateStoreInterface
{
    /** @var StoreRepository */
    private $repo;

    /**
     * @param StoreRepository $repo
     */
    public function __construct(StoreRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param int $id
     * @return Store|null
     */
    public function findById(int $id): ?Store
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
     * @return Store
     */
    public function create(array $args = []): Store
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
