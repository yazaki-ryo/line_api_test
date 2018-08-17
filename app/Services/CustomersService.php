<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Traits\Services\Creatable;
use App\Traits\Services\Deletable;
use App\Traits\Services\Findable;
use App\Traits\Services\Restorable;
use App\Traits\Services\Updatable;
use Domain\Contracts\Model\CreatableContract;
use Domain\Contracts\Model\DeletableContract;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\RestorableContract;
use Domain\Contracts\Model\UpdatableContract;

final class CustomersService implements
    CreatableContract,
    DeletableContract,
    FindableContract,
    RestorableContract,
    UpdatableContract
{
    use Creatable,
        Deletable,
        Findable,
        Restorable,
        Updatable;

    /** @var CustomerRepository */
    private $repo;

    /**
     * @param CustomerRepository $repo
     */
    public function __construct(CustomerRepository $repo)
    {
        $this->repo = $repo;
    }

}
