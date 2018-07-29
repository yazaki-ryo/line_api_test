<?php
declare(strict_types=1);

namespace Domain\UseCases\Config;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\UpdateUserInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Illuminate\Support\Collection;

final class UpdateProfile
{
    /** @var GetUserInterface */
    private $getUserService;

    /** @var UpdateUserInterface */
    private $updateUserService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param GetUserInterface $getUserService
     * @param UpdateUserInterface $updateUserService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        GetUserInterface $getUserService,
        UpdateUserInterface $updateUserService,
        TransactionalInterface $transactionalService
    ) {
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
        if (is_null($this->getUserService->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        $attributes = $this->domainize($attributes);

        return $this->transactionalService->transaction(function () use ($id, $attributes) {
            return $this->updateUserService->update($id, $attributes);
        });
    }

    /**
     * @param array $attributes
     * @return array
     */
    private function domainize(array $attributes = []): array
    {
        $attributes = collect($attributes);

        if ($attributes->has($key = 'password')) {
            $attributes = $attributes->when(empty($attributes->get($key)), function (Collection $item) use ($key) {
                return $item->except($key);
            }, function (Collection $item) use ($key) {
                return $item->put($key, bcrypt($item->get($key)));
            });
        }

        return $attributes->all();
    }

}
