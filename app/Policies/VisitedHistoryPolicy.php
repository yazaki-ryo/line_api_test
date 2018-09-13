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
    public function get(EloquentUser $user, VisitedHistory $visitedHistory): bool
    {
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('roles', 'store-user')
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
    public function create(EloquentUser $user, VisitedHistory $visitedHistory, Customer $customer): bool
    {
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional($customer->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('roles', 'store-user')
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
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('roles', 'store-user')
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
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional(optional($visitedHistory->customer())->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('roles', 'store-user')
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
//         if ($user->can('roles', 'company-admin')
//             && optional($user->store)->company_id === optional($visitedHistory->store())->companyId()
//         ) {
//             return true;
//         }

        return false;
    }

}
