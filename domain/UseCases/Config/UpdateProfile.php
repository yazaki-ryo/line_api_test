<?php
declare(strict_types=1);

namespace Domain\UseCases\Config;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\UpdateUserInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;

final class UpdateProfile
{
    /** @var GetUserInterface */
    private $getUserService;

    /** @var UpdateUserInterface */
    private $updateUserService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @return void
     */
    public function __construct(GetUserInterface $getUserService, UpdateUserInterface $updateUserService, TransactionalInterface $transactionalService)
    {
        $this->getUserService = $getUserService;
        $this->updateUserService = $updateUserService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User
    {
        return $this->getUserService->findById($id);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     * @throws NotFoundException
     */
    public function excute(int $id, array $attributes = []): bool
    {
        return $this->transactionalService->transaction(function () use ($id, $attributes) {

            if (is_null($user = $this->getUserService->findById($id))) {
                throw new NotFoundException('Resource not found.');
            }

            return $this->updateUserService->update($id, $attributes);
        });
    }

}
