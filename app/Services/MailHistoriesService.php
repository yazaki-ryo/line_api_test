<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\MailHistoryRepository;
use App\Traits\Services\Findable;
use App\Traits\Services\Updatable;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\UpdatableContract;

final class MailHistoriesService implements
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
    public function __construct(MailHistoryRepository $repo)
    {
        $this->repo = $repo;
    }
}
