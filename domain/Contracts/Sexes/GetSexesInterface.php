<?php
declare(strict_types=1);

namespace Domain\Contracts\Sexes;

use App\Services\Collection\DomainCollection;

interface GetSexesInterface
{
    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection;
}
