<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use App\Services\DomainCollection;

interface FindableContract
{
    /**
     * @param  int $id
     * @param  bool $trashed
     */
    public function find(int $id, bool $trashed = false);

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;

}
