<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableInterface;
use Domain\Contracts\Model\DeletableInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class DeleteCustomer
{
    /** @var FindableInterface */
    private $finder;

    /** @var DeletableInterface */
    private $deletor;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param FindableInterface $finder
     * @param DeletableInterface $deletor
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        FindableInterface $finder,
        DeletableInterface $deletor,
        TransactionalInterface $transactionalService
    ) {
        $this->finder = $finder;
        $this->deletor = $deletor;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($customer = $this->finder->findById($id))) {
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
            $this->deletor->delete($id);
        });
    }

}
