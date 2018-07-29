<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\CreateCustomerInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateCustomer
{
    /** @var CreateCustomerInterface */
    private $createCustomerService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param CreateCustomerInterface $createCustomerService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        CreateCustomerInterface $createCustomerService,
        TransactionalInterface $transactionalService
    ) {
        $this->createCustomerService = $createCustomerService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param array $args
     * @return Customer
     */
    public function excute(array $args = []): Customer
    {
        $args = $this->domainize($args);

        return $this->transactionalService->transaction(function () use ($args) {
            return $this->createCustomerService->create($args);
        });
    }

    /**
     * @param array $args
     * @return array
     */
    private function domainize(array $args = []): array
    {
        $args = collect($args);

        if ($this->auth->user()->cant('roles', 'company-admin')) {
            // TODO 管理者ロールは企業に紐付く店舗のみ、そうでないなら自身の所属する店舗のみ
        }

        if ($args->has($key = 'test')) {
//             $args->put($key, 'test');
        }

        return $args->all();
    }

}
