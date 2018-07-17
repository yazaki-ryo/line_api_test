<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Users\GetUsersInterface;

final class UsersService implements GetUsersInterface
{
    /** @var UserRepository */
    private $repo;

    /**
     * @param UserRepository $repo
     */
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        return $this->repo->findAll();
    }
}
