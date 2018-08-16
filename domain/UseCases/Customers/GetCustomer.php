<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableContract;
use Domain\Models\Customer;

final class GetCustomer
{
    /** @var FindableContract */
    private $finder;

    /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param  int $id
     * @param  bool $trashed
     * @return Customer|null
     */
    public function excute(int $id, bool $trashed = false): ?Customer
    {
        return $this->finder->findById($id, $trashed);
    }

}
