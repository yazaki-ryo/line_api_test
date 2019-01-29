<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
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
            $customer = $store->addCustomer($args);

            if (isset($args['visited_at'])) {
                $customer->addVisitedHistory([
                    'visited_at' => $args['visited_at'],
                ]);
            }

            return $customer;
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

        if ($args->has($key1 = 'visited_date') && ! is_null($date = $args->get($key1))) {
            if ($args->has($key2 = 'visited_time') && ! is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('visited_at', Carbon::parse($date));
        }

        return $args->all();
    }

}
