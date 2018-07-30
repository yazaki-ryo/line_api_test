<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\RestoreCustomerInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class RestoreCustomer
{
    /** @var GetCustomerInterface */
    private $getCustomerService;

    /** @var RestoreCustomerInterface */
    private $restoreCustomerService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param GetCustomerInterface $getCustomerService
     * @param RestoreCustomerInterface $restoreCustomerService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        GetCustomerInterface $getCustomerService,
        RestoreCustomerInterface $restoreCustomerService,
        TransactionalInterface $transactionalService
    ) {
        $this->getCustomerService = $getCustomerService;
        $this->restoreCustomerService = $restoreCustomerService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($customer = $this->getCustomerService->findById($id, true))) {
            throw new NotFoundException('Resource not found.');
        }

        return $customer;
    }

    /**
     * @param Auth $auth
     * @param int $id
     * @return void
     * @throws NotFoundException
     */
    public function excute(Auth $auth, int $id): void
    {
        $this->getCustomer($id);

        $this->transactionalService->transaction(function () use ($id) {
            $this->restoreCustomerService->restore($id);
        });
    }

}
