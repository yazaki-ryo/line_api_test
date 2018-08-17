<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Database\TransactionableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;

final class DeleteCustomer
{
    /** @var FindableContract */
    private $finder;

    /** @var TransactionableContract */
    private $transactionalService;

    /**
     * @param FindableContract $finder
     * @param TransactionableContract $transactionalService
     * @return void
     */
    public function __construct(
        FindableContract $finder,
        TransactionableContract $transactionalService
    ) {
        $this->finder = $finder;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Customer
     * @throws NotFoundException
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($resource = $this->finder->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $resource;
    }

    /**
     * @param User $user
     * @param Customer $customer
     * @return void
     */
    public function excute(User $user, Customer $customer): void
    {
        $this->transactionalService->transaction(function () use ($customer) {
            $customer->delete();
        });
    }

}
