<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\CreateCustomerInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Models\Customer;

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
     * @param array $attributes
     * @return Customer
     */
    public function excute(array $attributes = []): Customer
    {
        return $this->transactionalService->transaction(function () use ($attributes) {
            return $this->createCustomerService->create($attributes);
        });
    }

}
