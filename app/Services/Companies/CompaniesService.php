<?php
declare(strict_types=1);

namespace App\Services\Companies;

use App\Repositories\CompanyRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Companies\GetCompanyInterface;
use Domain\Contracts\Companies\GetCompaniesInterface;
use Domain\Contracts\Companies\UpdateCompanyInterface;
use Domain\Models\Company;

final class CompaniesService implements
    GetCompanyInterface,
    GetCompaniesInterface,
    UpdateCompanyInterface
{
    /** @var CompanyRepository */
    private $repo;

    /**
     * @param CompanyRepository $repo
     */
    public function __construct(CompanyRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param int $id
     * @return Company|null
     */
    public function findById(int $id): ?Company
    {
        return $this->repo->findById($id);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        return $this->repo->findAll($args);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes = []): bool
    {
        return $this->repo->update($id, $attributes);
    }
}
