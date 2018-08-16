<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\StoreRepository;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\UpdatableContract;
use Domain\Models\Store;

final class StoresService implements
    FindableContract,
    UpdatableContract
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
     * @param  int $id
     * @param  bool $trashed
     * @return Store|null
     */
    public function findById(int $id, bool $trashed = false): ?Store
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
     * @param  int $id
     * @param  array $args
     * @return bool
     */
    public function update(int $id, array $args = [])
    {
        return $this->repo->update($id, $args);
    }

}
