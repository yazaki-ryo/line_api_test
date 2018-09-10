<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;

final class CreateVisitedHistory
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
     * @param User $user
     * @param Customer $customer
     * @param array $args
     * @return Customer
     */
    public function excute(User $user, Customer $customer, array $args = []): VisitedHistory
    {
        $args = $this->domainize($user, $customer, $args);

        return $this->transaction(function () use ($customer, $args) {
            return $customer->createVisitedHistory($args);
        });
    }

    /**
     * @param User $user
     * @param Customer $customer
     * @param array $args
     * @return array
     */
    private function domainize(User $user, Customer $customer, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key1 = 'visited_date')) {
            $date = $args->get($key1);

            if ($args->has($key2 = 'visited_time')) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('visited_at', Carbon::createFromTimeString($date));
        }

        return $args->all();
    }

}
