<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\PrefectureRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class PrefecturesService implements FindableContract
{
    use Findable;

    /** @var PrefectureRepository */
    private $repo;

    /**
     * @param PrefectureRepository $repo
     */
    public function __construct(PrefectureRepository $repo)
    {
        $this->repo = $repo;
    }
}
