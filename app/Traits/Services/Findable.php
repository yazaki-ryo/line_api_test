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
    public function findById(int $id, bool $trashed = false): ?DomainModel
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
}
