<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\TagRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class TagsService implements FindableContract
{
    use Findable;

    /** @var TagRepository */
    private $repo;

    /**
     * @param TagRepository $repo
     */
    public function __construct(TagRepository $repo)
    {
        $this->repo = $repo;
    }
}
