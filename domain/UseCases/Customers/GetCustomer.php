<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Models\Customer;

final class GetCustomer
{
    /** @var GetCustomerInterface */
    private $getCustomerService;

    /**
     * @param GetCustomerInterface $usersService
     * @return void
     */
    public function __construct(GetCustomerInterface $getCustomerService)
    {
        $this->getCustomerService = $getCustomerService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function excute(int $id): Customer
    {
        return $this->getCustomerService->findById($id);
    }

}
