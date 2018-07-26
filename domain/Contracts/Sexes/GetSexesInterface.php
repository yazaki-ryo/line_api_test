<?php
declare(strict_types=1);

namespace Domain\Contracts\Sexes;

use App\Services\Collection\DomainCollection;

interface GetSexesInterface
{
    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;
}
