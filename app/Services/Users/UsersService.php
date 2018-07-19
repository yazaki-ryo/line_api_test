<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\GetUsersInterface;
use Domain\Contracts\Users\UpdateUserInterface;
use Domain\Models\User;

final class UsersService implements GetUserInterface, GetUsersInterface, UpdateUserInterface
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
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return $this->repo->findById($id);
    }

    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        return $this->repo->findAll();
    }

    /**
     * @param int $id
     * @param array $inputs
     * @return bool
     */
    public function update(int $id, array $inputs = []): bool
    {
        return $this->repo->update($id, $inputs);
    }
}
