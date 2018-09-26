<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class RolesService implements FindableContract
{
    use Findable;

    /** @var RoleRepository */
    private $repo;

    /**
     * @param RoleRepository $repo
     */
    public function __construct(RoleRepository $repo)
    {
        $this->repo = $repo;
    }
}
