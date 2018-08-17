<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use Domain\Contracts\Users\GetUserContract;
use Domain\Models\User;

final class GetUser
{
    /** @var GetUserContract */
    private $usersService;

    /**
     * @return void
     */
    public function __construct(GetUserContract $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @param int $id
     * @return User
     */
    public function excute(int $id): User
    {
        return $this->usersService->findById($id);
    }

}
