<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;

final class RestoreCustomer
{
    /** @var FindableInterface */
    private $finder;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param FindableInterface $finder
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        FindableInterface $finder,
        TransactionalInterface $transactionalService
    ) {
        $this->finder = $finder;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param  int $id
     * @return Customer
     * @throws NotFoundException
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($resource = $this->finder->findById($id, true))) {
            throw new NotFoundException('Resource not found.');
        }

        return $resource;
    }

    /**
     * @param  User $user
     * @param  Customer $customer
     * @return void
     */
    public function excute(User $user, Customer $customer): void
    {
        $this->transactionalService->transaction(function () use ($customer) {
            $customer->restore();
        });
    }

}
