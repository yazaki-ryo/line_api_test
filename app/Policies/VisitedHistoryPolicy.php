<?php
declare(strict_types=1);

namespace App\Policies;

use App\Eloquents\EloquentUser;
use Domain\Models\Customer;
use Domain\Models\VisitedHistory;
use Illuminate\Auth\Access\HandlesAuthorization;

final class VisitedHistoryPolicy
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
     * @param  VisitedHistory  $visitedHistory
     * @return bool
     */
    public function select(EloquentUser $user, VisitedHistory $visitedHistory): bool
    {
        if ($user->can('authorize', 'customers-visited_histories.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers-visited_histories.select')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers-visited_histories.select')
            && $user->store_id === optional($visitedHistory->customer())->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     *
     * @param EloquentUser $user
     * @param VisitedHistory $visitedHistory
     * @param Customer $customer
     * @return bool
     */
    public function create(EloquentUser $user, VisitedHistory $visitedHistory, Customer $customer): bool
    {
        if ($user->can('authorize', 'customers-visited_histories.create')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers-visited_histories.create')
            && optional($user->store)->company_id === optional($customer->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers-visited_histories.create')
            && $user->store_id === $customer->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  VisitedHistory  $visitedHistory
     * @return bool
     */
    public function update(EloquentUser $user, VisitedHistory $visitedHistory): bool
    {
        if ($user->can('authorize', 'customers-visited_histories.update')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers-visited_histories.update')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers-visited_histories.update')
            && $user->store_id === optional($visitedHistory->customer())->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  VisitedHistory  $visitedHistory
     * @return bool
     */
    public function delete(EloquentUser $user, VisitedHistory $visitedHistory): bool
    {
        if ($user->can('authorize', 'customers-visited_histories.delete')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers-visited_histories.delete')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers-visited_histories.delete')
            && $user->store_id === optional($visitedHistory->customer())->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  VisitedHistory  $visitedHistory
     * @return bool
     */
    public function restore(EloquentUser $user, VisitedHistory $visitedHistory): bool
    {
        if ($user->can('authorize', 'customers-visited_histories.restore')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-customers-visited_histories.restore')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-customers-visited_histories.restore')
            && $user->store_id === optional($visitedHistory->customer())->storeId()
        ) {
            return true;
        }

        return false;
    }

}
