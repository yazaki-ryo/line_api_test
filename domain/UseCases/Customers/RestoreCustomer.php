<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableInterface;
use Domain\Contracts\Model\RestorableInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class RestoreCustomer
{
    /** @var FindableInterface */
    private $finder;

    /** @var RestorableInterface */
    private $restorer;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param FindableInterface $finder
     * @param RestorableInterface $restorer
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        FindableInterface $finder,
        RestorableInterface $restorer,
        TransactionalInterface $transactionalService
    ) {
        $this->finder = $finder;
        $this->restorer = $restorer;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($customer = $this->finder->findById($id, true))) {
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
            $this->restorer->restore($id);
        });
    }

}
