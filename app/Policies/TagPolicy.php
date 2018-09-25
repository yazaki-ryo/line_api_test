<?php
declare(strict_types=1);

namespace App\Policies;

use App\Eloquents\EloquentUser;
use Domain\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

final class TagPolicy
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
     * @param  Tag  $tag
     * @return bool
     */
    public function get(EloquentUser $user, Tag $tag): bool
    {
        if ($user->can('roles', [
            'company-admin',
            'store-user',
        ]) && $user->store_id === $tag->storeId()) {
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
     * @param  Tag  $tag
     * @return bool
     */
    public function update(EloquentUser $user, Tag $tag): bool
    {
        if ($user->can('roles', [
            'company-admin',
            'store-user',
        ]) && $user->store_id === $tag->storeId()) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Tag  $tag
     * @return bool
     */
    public function delete(EloquentUser $user, Tag $tag): bool
    {
        if ($user->can('roles', 'company-admin')
            && $user->store_id === $tag->storeId()) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Tag  $tag
     * @return bool
     */
    public function restore(EloquentUser $user, Tag $tag): bool
    {
        return false;
    }

}
