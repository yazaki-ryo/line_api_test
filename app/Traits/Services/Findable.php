<?php
declare(strict_types=1);

namespace App\Traits\Services;

use App\Services\DomainCollection;
use Domain\Models\DomainModel;

trait Findable
{
    /**
     * @param int $id
     * @return DomainModel|null
     */
    public function find(int $id): ?DomainModel
    {
        return $this->repo->find($id);
    }

    /**
     * @param array $ids
     * @return DomainCollection
     */
    public function findMany(array $ids = []): DomainCollection
    {
        return $this->repo->findMany($ids);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        return $this->repo->findAll($args);
    }
}
