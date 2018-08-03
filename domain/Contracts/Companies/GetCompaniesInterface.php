<?php
declare(strict_types=1);

namespace Domain\Contracts\Companies;

use App\Services\Collection\DomainCollection;

interface GetCompaniesInterface
{
    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection;
}
