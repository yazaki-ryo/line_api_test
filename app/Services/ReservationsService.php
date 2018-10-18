<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\ReservationRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class ReservationsService implements FindableContract
{
    use Findable;

    /** @var ReservationRepository */
    private $repo;

    /**
     * @param ReservationRepository $repo
     */
    public function __construct(ReservationRepository $repo)
    {
        $this->repo = $repo;
    }
}
