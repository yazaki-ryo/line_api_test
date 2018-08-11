<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use Domain\Models\User;

final class UsersService
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

}
