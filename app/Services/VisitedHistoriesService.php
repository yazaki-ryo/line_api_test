<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\VisitedHistoryRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class VisitedHistoriesService implements FindableContract
{
    use Findable;

    /** @var VisitedHistoryRepository */
    private $repo;

    /**
     * @param VisitedHistoryRepository $repo
     */
    public function __construct(VisitedHistoryRepository $repo)
    {
        $this->repo = $repo;
    }
}
