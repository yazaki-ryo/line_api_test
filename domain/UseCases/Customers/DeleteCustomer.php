<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\DeleteCustomerInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class DeleteCustomer
{
    /** @var GetCustomerInterface */
    private $getCustomerService;

    /** @var DeleteCustomerInterface */
    private $deleteCustomerService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param GetCustomerInterface $getCustomerService
     * @param DeleteCustomerInterface $deleteCustomerService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        GetCustomerInterface $getCustomerService,
        DeleteCustomerInterface $deleteCustomerService,
        TransactionalInterface $transactionalService
    ) {
        $this->getCustomerService = $getCustomerService;
        $this->deleteCustomerService = $deleteCustomerService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($customer = $this->getCustomerService->findById($id))) {
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
            $this->deleteCustomerService->delete($id);
        });
    }

}
