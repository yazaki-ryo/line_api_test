<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\SexRepository;
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

final class SexesService implements
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

    /** @var SexRepository */
    private $repo;

    /**
     * @param SexRepository $repo
     */
    public function __construct(SexRepository $repo)
    {
        $this->repo = $repo;
    }
}
