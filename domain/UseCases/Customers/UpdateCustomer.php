<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\UpdateCustomerInterface;
use Domain\Contracts\Prefectures\GetPrefecturesInterface;
use Domain\Contracts\Sexes\GetSexesInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;

final class UpdateCustomer
{
    /** @var GetCustomerInterface */
    private $getCustomerService;

    /** @var UpdateCustomerInterface */
    private $updateCustomerService;

    /** @var GetPrefecturesInterface */
    private $getPrefecturesService;

    /** @var GetSexesInterface */
    private $getSexesService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @return void
     */
    public function __construct(
        GetCustomerInterface $getCustomerService,
        UpdateCustomerInterface $updateCustomerService,
        GetPrefecturesInterface $getPrefecturesService,
        GetSexesInterface $getSexesService,
        TransactionalInterface $transactionalService
    ) {
        $this->getCustomerService = $getCustomerService;
        $this->updateCustomerService = $updateCustomerService;
        $this->getPrefecturesService = $getPrefecturesService;
        $this->getSexesService = $getSexesService;
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
     * @return DomainCollection
     */
    public function getPrefectures(): DomainCollection
    {
        return $this->getPrefecturesService->findAll();
    }

    /**
     * @return DomainCollection
     */
    public function getSexes(): DomainCollection
    {
        return $this->getSexesService->findAll();
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     * @throws NotFoundException
     */
    public function excute(int $id, array $attributes = []): bool
    {
        return $this->transactionalService->transaction(function () use ($id, $attributes) {
            $this->getCustomerService->findById($id);
            return $this->updateCustomerService->update($id, $attributes);
        });
    }

}
