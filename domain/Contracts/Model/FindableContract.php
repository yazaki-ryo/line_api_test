<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use App\Services\DomainCollection;
use Domain\Models\DomainModel;

interface FindableContract
{
    /**
     * @param  int $id
     * @return DomainModel|null
     */
    public function find(int $id): ?DomainModel;

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;

}
