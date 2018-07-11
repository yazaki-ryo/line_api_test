<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use Illuminate\Database\Eloquent\Collection;

final class GetUsers
{
    /** @var GetUsersInterface $getUsersService */
    private $getUsersService;

    /**
     * @return void
     */
    public function __construct(GetUsersInterface $getUsersService)
    {
        $this->getUsersService = $getUsersService;
    }

    /**
     * @return mixed
     */
    public function excute()
    {
        return $this->getUsersService->findUsers();
    }

}

interface GetUsersInterface
{
    /**
     * @return Collection
     */
    public function findUsers(): Collection;
}
