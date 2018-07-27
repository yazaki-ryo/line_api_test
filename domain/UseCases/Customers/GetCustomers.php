<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Customers\GetCustomersInterface;

final class GetCustomers
{
    /** @var GetCustomersInterface */
    private $getCustomersService;

    /**
     * @param GetCustomersInterface $getCustomersService
     * @return void
     */
    public function __construct(GetCustomersInterface $getCustomersService)
    {
        $this->getCustomersService = $getCustomersService;
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function excute(array $args = []): DomainCollection
    {
        return $this->getCustomersService->findAll($args);
    }

}
