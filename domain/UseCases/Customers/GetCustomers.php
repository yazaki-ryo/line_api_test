<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\DomainCollection;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\User;

final class GetCustomers
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param array $args
     * @return DomainCollection
     */
    public function excute(User $user, array $args = []): DomainCollection
    {
        return $this->domainize($user, $args);
    }

    /**
     * @param User $user
     * @param array $args
     * @return DomainCollection
     */
    private function domainize(User $user, array $args = []): DomainCollection
    {
        /** @var Collection $collection */
        $collection = collect($args);

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        if (! is_null($company) && $user->can('roles', 'company-admin')) {
            return $company->customers($collection->all());
        } elseif (! is_null($store) && $user->can('roles', 'store-user')) {
            return $store->customers($collection->all());
        } else {
            return new DomainCollection;
        }
    }

}
