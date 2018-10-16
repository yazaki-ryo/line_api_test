<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\Store;
use Domain\Models\User;

final class CreateCustomer
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
     * @param  array $args
     * @return Store
     * @throws NotFoundException
     */
    public function getStore(array $args): Store
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     * @return Customer
     */
    public function excute(User $user, Store $store, array $args = []): Customer
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($store, $args) {
            return $store->addCustomer($args);
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'mourning_flag') && (bool)$args->get($key)) {
            $args['mourned_at'] = now();
        }

        return $args->all();
    }

}
