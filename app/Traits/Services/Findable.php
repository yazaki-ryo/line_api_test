<?php
declare(strict_types=1);

namespace App\Traits\Services;

use App\Services\DomainCollection;
use Domain\Models\DomainModel;

trait Findable
{
    /**
     * @param int $id
     * @param bool $trashed
     * @return DomainModel|null
     */
    public function find(int $id, bool $trashed = false): ?DomainModel
    {
        return $this->repo->find($id, $trashed);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findMany(array $args = []): DomainCollection
    {
        return $this->repo->findMany($args);
    }
}
