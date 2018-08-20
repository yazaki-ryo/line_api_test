<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Traits\Services\Findable;
use App\Traits\Services\Updatable;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\UpdatableContract;

final class CompaniesService implements
    FindableContract,
    UpdatableContract
{
    use Findable,
        Updatable;

    /** @var CompanyRepository */
    private $repo;

    /**
     * @param CompanyRepository $repo
     */
    public function __construct(CompanyRepository $repo)
    {
        $this->repo = $repo;
    }
}
