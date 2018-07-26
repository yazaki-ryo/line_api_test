<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Customers\CreateCustomerInterface;
use Domain\Contracts\Prefectures\GetPrefecturesInterface;
use Domain\Contracts\Sexes\GetSexesInterface;
use Domain\Models\Customer;

final class CreateCustomer
{
    /** @var CreateCustomerInterface */
    private $createCustomerService;

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
        CreateCustomerInterface $createCustomerService,
        GetPrefecturesInterface $getPrefecturesService,
        GetSexesInterface $getSexesService,
        TransactionalInterface $transactionalService
    ) {
        $this->createCustomerService = $createCustomerService;
        $this->getPrefecturesService = $getPrefecturesService;
        $this->getSexesService = $getSexesService;
        $this->transactionalService = $transactionalService;
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
