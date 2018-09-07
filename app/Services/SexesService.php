<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\SexRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class SexesService implements FindableContract
{
    use Findable;

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
