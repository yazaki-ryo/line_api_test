<?php
declare(strict_types=1);

namespace Domain\UseCases\Configurations;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Stores\GetStoreInterface;
use Domain\Contracts\Stores\UpdateStoreInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Store;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateStore
{
    /** @var GetStoreInterface */
    private $getStoreService;

    /** @var UpdateStoreInterface */
    private $updateStoreService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param GetStoreInterface $getStoreService
     * @param UpdateStoreInterface $updateStoreService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        GetStoreInterface $getStoreService,
        UpdateStoreInterface $updateStoreService,
        TransactionalInterface $transactionalService
    ) {
        $this->getStoreService = $getStoreService;
        $this->updateStoreService = $updateStoreService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Store
     * @throws NotFoundException
     */
    public function getStore(int $id): Store
    {
        if (is_null($store = $this->getStoreService->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $store;
    }

    /**
     * @param Auth $auth
     * @param int $id
     * @param array $args
     * @return bool
     * @throws NotFoundException
     */
    public function excute(Auth $auth, int $id, array $args = []): bool
    {
        $this->getStore($id);

        $args = $this->domainize($auth, $args);

        return $this->transactionalService->transaction(function () use ($id, $args) {
            return $this->updateStoreService->update($id, $args);
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

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
