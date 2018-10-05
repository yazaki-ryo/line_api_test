<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Traits\Services\Findable;
use Domain\Contracts\Model\FindableContract;

final class PermissionsService implements FindableContract
{
    use Findable;

    /** @var PermissionRepository */
    private $repo;

    /**
     * @param PermissionRepository $repo
     */
    public function __construct(PermissionRepository $repo)
    {
        $this->repo = $repo;
    }
}
