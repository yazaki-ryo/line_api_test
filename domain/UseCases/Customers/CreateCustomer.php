<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\CreatableContract;
use Domain\Models\Customer;
use Domain\Models\User;

final class CreateCustomer
{
    use Transactionable;

    /** @var CreatableContract */
    private $creator;

    /**
     * @param CreatableContract $creator
     * @return void
     */
    public function __construct(CreatableContract $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @param User $user
     * @param array $args
     * @return Customer
     */
    public function excute(User $user, array $args = []): Customer
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($args) {
            return $this->creator->create($args);
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
