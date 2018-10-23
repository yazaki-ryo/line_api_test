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
    public function select(EloquentUser $user, User $targetUser): bool
    {
        if ($user->can('authorize', 'users.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-users.select')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-users.select')
            && $user->store_id === $targetUser->storeId()
        ) {
            return true;
        } elseif ($user->id === $targetUser->id()) {
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
        if ($user->can('authorize', 'users.update')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-users.update')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-users.update')
            && $user->store_id === $targetUser->storeId()
        ) {
            return true;
        } elseif ($user->id === $targetUser->id()) {
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
        if ($user->id === $targetUser->id()) {
            return false;
        }

        if ($user->can('authorize', 'users.delete')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-users.delete')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-users.delete')
            && $user->store_id === $targetUser->storeId()
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
        if ($user->id === $targetUser->id()) {
            return false;
        }

        if ($user->can('authorize', 'users.restore')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-users.restore')
            && optional($user->store)->company_id === optional($targetUser->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-users.restore')
            && $user->store_id === $targetUser->storeId()
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
    public function changeRole(EloquentUser $user, User $targetUser): bool
    {
        if ($user->id === $targetUser->id()) {
            return false;
        }

        if ($user->can('authorize', config('permissions.groups.users.create'))) {
            return true;
        }

        return false;
    }

}
