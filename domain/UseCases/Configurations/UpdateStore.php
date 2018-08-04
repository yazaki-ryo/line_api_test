<?php
declare(strict_types=1);

namespace Domain\UseCases\Configurations;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Store;
use Domain\Models\User;

final class UpdateStore
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
     * @param User $user
     * @return Store
     * @throws NotFoundException
     */
    public function getStore(User $user): Store
    {
        if (is_null($resource = $user->store())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param array $args
     * @return bool
     * @throws NotFoundException
     */
    public function excute(User $user, array $args = []): bool
    {
        $resource = $this->getStore($user);
        $args = $this->domainize($user, $args);

        return $this->transactionalService->transaction(function () use ($resource, $args) {
            return $resource->update($args);
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

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
