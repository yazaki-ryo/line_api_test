<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use App\Services\DomainCollection;
use Domain\Contracts\Users\GetUsersContract;

final class GetUsers
{
    /** @var GetUsersContract */
    private $usersService;

    /**
     * @return void
     */
    public function __construct(GetUsersContract $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function excute(array $args = []): DomainCollection
    {
        return $this->usersService->findAll($args);
    }

}
