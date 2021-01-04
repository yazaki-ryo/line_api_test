<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\PrintHistoryRepository;
use App\Traits\Services\Findable;
use App\Traits\Services\Creatable;
use App\Traits\Services\Deletable;
use App\Traits\Services\Updatable;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\CreatableContract;
use Domain\Contracts\Model\DeletableContract;
use Domain\Contracts\Model\UpdatableContract;

final class PrintHistoriesService implements
    FindableContract,
    CreatableContract,
    DeletableContract,
    UpdatableContract
{
    use Findable,
        Creatable,
        Deletable,
        Updatable;

    /** @var StoreRepository */
    private $repo;

    /**
     * @param StoreRepository $repo
     */
    public function __construct(PrintHistoryRepository $repo)
    {
        $this->repo = $repo;
    }
}
