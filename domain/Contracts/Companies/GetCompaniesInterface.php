<?php
declare(strict_types=1);

namespace Domain\Contracts\Companies;

use App\Services\Collection\DomainCollection;

interface GetCompaniesInterface
{
    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection;
}
