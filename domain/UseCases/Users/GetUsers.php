<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use Domain\Contracts\Users\GetUsersInterface;
use Illuminate\Support\Collection;

final class GetUsers
{
    /** @var GetUsersInterface */
    private $usersService;

    /**
     * @return void
     */
    public function __construct(GetUsersInterface $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @return Collection
     */
    public function excute(): Collection
    {
        return $this->usersService->findAll();
    }

}
