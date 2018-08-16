<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\CompanyRepository;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\UpdatableContract;
use Domain\Models\Company;

final class CompaniesService implements
    FindableContract,
    UpdatableContract
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

    /**
     * @param  int $id
     * @param  array $args
     * @return bool
     */
    public function update(int $id, array $args = [])
    {
        return $this->repo->update($id, $args);
    }
}
