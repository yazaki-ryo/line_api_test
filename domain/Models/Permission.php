<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\PermissionRepository;
use App\Services\Collection\DomainCollection;

final class Permission
{
    /** @var PermissionRepository */
    private $repo;

    /** @var string */
    private $name;

    /** @var string */
    private $slug;

    /**
     * @param PermissionRepository $repo
     * @return void
     */
    public function __construct(PermissionRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return string
     */
    public function name(): string
    {
//         return $this->repo->name();
    }

    /**
     * @return string
     */
    public function slug(): string
    {
        return $this->repo->slug();
    }

    /**
     * @param PermissionRepository
     * @return self
     */
    public static function of(PermissionRepository $repo): self
    {
        return new self($repo);
    }

}
