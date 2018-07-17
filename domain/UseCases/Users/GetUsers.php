<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Users\GetUsersInterface;

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
     * @return DomainCollection
     */
    public function excute(): DomainCollection
    {
        return $this->usersService->findAll();
    }

}
