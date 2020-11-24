<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\PrintHistoryRepository;
use App\Traits\Services\Findable;
use App\Traits\Services\Updatable;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\UpdatableContract;

final class PrintHistoriesService implements
    FindableContract,
    UpdatableContract
{
    use Findable,
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
