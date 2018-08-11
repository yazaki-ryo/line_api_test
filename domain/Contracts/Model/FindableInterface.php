<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use App\Services\DomainCollection;

interface FindableInterface
{
    /**
     * @param  int $id
     * @param  bool $trashed
     */
    public function findById(int $id, bool $trashed = false);

    /**
     * @param array $ids
     * @return DomainCollection
     */
//     public function findMany(array $ids = []): DomainCollection;

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;

}
