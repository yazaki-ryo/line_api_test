<?php
declare(strict_types=1);

namespace Domain\UseCases\Reservations;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Store;
use Domain\Models\User;
use Domain\Models\Reservation;

final class CreateReservation
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
     * @return Reservation
     */
    public function excute(User $user, Store $store, array $args = []): Reservation
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($store, $args) {
            if (!array_key_exists('customer_id', $args) || !$args['customer_id']) {
                $customer = $store->addCustomer(['last_name' => $args['name']]);
                debug($customer);
                if ($customer && $customer->id() > 0) {
                    $args['customer_id'] = $customer->id();
                } else {
                    throw new \Exception('failed to create customer');
                }
            }
            
            return $store->addReservation($args);
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

        if ($args->has($key1 = 'reserved_date') && ! is_null($date = $args->get($key1))) {
            if ($args->has($key2 = 'reserved_time') && ! is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('reserved_at', Carbon::parse($date));
        }

        return $args->all();
    }

}
