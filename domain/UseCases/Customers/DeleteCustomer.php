<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use App\Services\DomainCollection;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;

final class DeleteCustomer
{
    use Transactionable;

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
    
    public function deleteMultiple(User $user, array $targetCustomerIds) {
        $customers = $this->getCustomers(['customer_ids' => $targetCustomerIds])->all();
        return $this->transaction(function () use ($customers) {
            foreach ($customers as $customer) {
                $customer->delete();
            }
            return true;
        });
    }
    
    
    public function getCustomers(array $args): DomainCollection
    {
        if (is_null($resource = $this->finder->findAll($args))) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param  array $args
     * @return Customer
     * @throws NotFoundException
     */
    public function getCustomer(array $args): Customer
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
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
        $this->transaction(function () use ($customer) {
            $customer->delete();
        });
    }

}
