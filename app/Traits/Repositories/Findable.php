<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

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
        if (is_null($resource = $this->eloquent->find($id))) {
            return null;
        }
        return static::toModel($resource);
    }

    /**
     * @param array $ids
     * @return DomainCollection
     */
    public function findMany(array $ids = []): DomainCollection
    {
        $collection = $this->eloquent->findMany($ids);
        return static::toModels($collection);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        $collection = $this->build($this->newQuery(), $args)->get();
        return static::toModels($collection);
    }
}
