<?php
declare(strict_types=1);

namespace Domain\UseCases\Config;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Contracts\Users\UpdateUserInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;
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
     * @throws NotFoundException
     */
    public function getUser(int $id): User
    {
        if (is_null($this->getUserService->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $this->getUserService->findById($id);
    }

    /**
     * @param  Auth $auth
     * @param  int $id
     * @param  array $args
     * @return bool
     * @throws NotFoundException
     */
    public function excute(Auth $auth, int $id, array $args = []): bool
    {
        $this->getUser($id);

        $args = $this->domainize($auth, $args);

        return $this->transactionalService->transaction(function () use ($id, $args) {
            return $this->updateUserService->update($id, $args);
        });
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return array
     */
    private function domainize(Auth $auth, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'password')) {
            $args = $args->when(empty($args->get($key)), function (Collection $item) use ($key) {
                return $item->except($key);
            }, function (Collection $item) use ($key) {
                return $item->put($key, bcrypt($item->get($key)));
            });
        }

        return $args->all();
    }

}
