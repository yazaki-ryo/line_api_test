<?php
declare(strict_types=1);

namespace Domain\UseCases\Configurations;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Illuminate\Support\Collection;

final class UpdateProfile
{
    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(TransactionalInterface $transactionalService)
    {
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param  User $user
     * @param  array $args
     * @return bool
     * @throws NotFoundException
     */
    public function excute(User $user, array $args = []): bool
    {
        if (is_null($user)) throw new NotFoundException('Resource not found.');

        $args = $this->domainize($user, $args);

        return $this->transactionalService->transaction(function () use ($user, $args) {
            return $user->update($args);
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
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
