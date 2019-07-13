<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\SeatRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class SeatsService implements FindableContract
{
    use Findable;

    /** @var SeatRepository */
    private $repo;

    /**
     * @param SeatRepository $repo
     */
    public function __construct(SeatRepository $repo)
    {
        $this->repo = $repo;
    }
}
