<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\VisitedHistories;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;

final class UpdateVisitedHistory
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
     * @param  int $id
     * @param Customer $customer
     * @return VisitedHistory
     * @throws NotFoundException
     */
    public function getVisitedHistory(Customer $customer, int $id): VisitedHistory
    {
        if (is_null($resource = $customer->visitedHistories(['id' => $id])->first())) {
            throw new NotFoundException('Resource not found.');
        }

        return $resource;
    }

    /**
     * @param User $user
     * @param VisitedHistory $visitedHistory
     * @param array $args
     * @return bool
     */
    public function excute(User $user, VisitedHistory $visitedHistory, array $args = []): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($visitedHistory, $args) {
            return $visitedHistory->update($args);
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

        if ($args->has($key1 = 'visited_date')) {
            $date = $args->get($key1);

            if ($args->has($key2 = 'visited_time') && !is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('visited_at', Carbon::parse($date));
        }

        return $args->all();
    }

}
