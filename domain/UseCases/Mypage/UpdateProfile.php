<?php
declare(strict_types=1);

namespace Domain\UseCases\Mypage;

use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\UpdateUserInterface;
use Domain\Models\User;

final class UpdateProfile
{
    /** @var GetUserInterface */
    private $getUserService;

    /** @var UpdateUserInterface */
    private $updateUserService;

    /**
     * @return void
     */
    public function __construct(GetUserInterface $getUserService, UpdateUserInterface $updateUserService)
    {
        $this->getUserService = $getUserService;
        $this->updateUserService = $updateUserService;
    }

    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User
    {
        return $this->getUserService->findById($id);
    }

    /**
     * @param int $id
     * @return User
     */
    public function excute(int $id): User
    {
        return $this->updateUserService->update($id);
    }

}
