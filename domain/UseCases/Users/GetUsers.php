<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use Illuminate\Support\Collection;

final class GetUsers
{
    /** @var GetUsersInterface */
    private $getUsersService;

    /**
     * @return void
     */
    public function __construct(GetUsersInterface $getUsersService)
    {
        $this->getUsersService = $getUsersService;
    }

    /**
     * @return Collection
     */
    public function excute(): Collection
    {
        return $this->getUsersService->findAll();
    }

}

interface GetUsersInterface
{
    /**
     * @return Collection
     */
    public function findAll(): Collection;
}
