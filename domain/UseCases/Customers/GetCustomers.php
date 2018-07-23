<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Customers\GetCustomersInterface;

final class GetCustomers
{
    /** @var GetCustomersInterface */
    private $usersService;

    /**
     * @return void
     */
    public function __construct(GetCustomersInterface $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @return DomainCollection
     */
    public function excute(): DomainCollection
    {
        return $this->usersService->findAll();
    }

}
