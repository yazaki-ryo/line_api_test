<?php
declare(strict_types=1);

namespace App\Policies;

use App\Eloquents\EloquentUser;
use Domain\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

final class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * @param  EloquentUser  $user
     * @param  string  $ability
     * @return boolean|null
     */
    public function before(EloquentUser $user, string $ability): ?bool
    {
        return null;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function select(EloquentUser $user, Customer $customer): bool
    {
        if ($user->can('authorize', 'customers.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers.select')
            && optional($user->store)->company_id === optional($customer->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers.select')
            && $user->store_id === $customer->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @return bool
     */
    public function create(EloquentUser $user): bool
    {
        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function update(EloquentUser $user, Customer $customer): bool
    {
        if ($user->can('authorize', 'customers.update')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers.update')
            && optional($user->store)->company_id === optional($customer->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers.update')
            && $user->store_id === $customer->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function delete(EloquentUser $user, Customer $customer): bool
    {
        if ($user->can('authorize', 'customers.delete')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers.delete')
            && optional($user->store)->company_id === optional($customer->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers.delete')
            && $user->store_id === $customer->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function restore(EloquentUser $user, Customer $customer): bool
    {
        if ($user->can('authorize', 'customers.restore')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers.restore')
            && optional($user->store)->company_id === optional($customer->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers.restore')
            && $user->store_id === $customer->storeId()
        ) {
            return true;
        }

        return false;
    }

}
