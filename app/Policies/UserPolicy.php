<?php
declare(strict_types=1);

namespace App\Policies;

use App\Eloquents\EloquentUser;
use Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicy
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
     * @param  User  $targetUser
     * @return bool
     */
    public function get(EloquentUser $user, User $targetUser): bool
    {
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('roles', 'store-user')
            && $user->store_id === $targetUser->storeId()
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
     * @param  User  $targetUser
     * @return bool
     */
    public function update(EloquentUser $user, User $targetUser): bool
    {
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('roles', 'store-user')
            && $user->id === $targetUser->id()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function delete(EloquentUser $user, User $targetUser): bool
    {
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
            && $user->id !== $targetUser->id()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  User  $targetUser
     * @return bool
     */
    public function restore(EloquentUser $user, User $targetUser): bool
    {
        if ($user->can('roles', 'company-admin')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        }

        return false;
    }

}
