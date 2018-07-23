<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Models\Customer;

final class GetCustomer
{
    /** @var GetCustomerInterface */
    private $usersService;

    /**
     * @return void
     */
    public function __construct(GetCustomerInterface $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function excute(int $id): Customer
    {
        return $this->usersService->findById($id);
    }

}
