<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;

final class UpdateCustomer
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

    /**
     * @param  int $id
     * @return Customer
     * @throws NotFoundException
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($resource = $this->finder->find($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $resource;
    }

    /**
     * @param  User $user
     * @param  Customer $customer
     * @param  array $args
     * @return bool
     */
    public function excute(User $user, Customer $customer, array $args = []): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($customer, $args) {
            $customer->toggleTimestamp('mourned_at', (bool)$args['mourning_flag']);
            return $customer->update($args);
        });
    }

    /**
     * @param  User $user
     * @param  array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
