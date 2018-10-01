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

        if ($collection->has($key = 'mourning_flag') && ! is_null($collection->get($key))) {
            $collection->put($key, ! ((bool)$collection->get($key)));
        }

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        if ($user->can('authorize', 'customers.select')) {
            // TODO
        } elseif ($user->can('authorize', 'own-company-customers.select') && ! is_null($company)) {
            return $company->customers($collection->all());
        } elseif ($user->can('authorize', 'own-company-self-store-customers.select') && ! is_null($store)) {
            return $store->customers($collection->all());
        } else {
            return new DomainCollection;
        }
    }

}
