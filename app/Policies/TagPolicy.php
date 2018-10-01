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
    public function select(EloquentUser $user, Tag $tag): bool
    {
        if ($user->can('authorize', 'tags.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-tags.select')
            && optional($user->store)->company_id === optional($tag->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-tags.select')
            && $user->store_id === $tag->storeId()
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
     * @param  Tag  $tag
     * @return bool
     */
    public function update(EloquentUser $user, Tag $tag): bool
    {
        if ($user->can('authorize', 'tags.update')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-tags.update')
            && optional($user->store)->company_id === optional($tag->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-tags.update')
            && $user->store_id === $tag->storeId()
        ) {
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
        if ($user->can('authorize', 'tags.delete')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-tags.delete')
            && optional($user->store)->company_id === optional($tag->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-tags.delete')
            && $user->store_id === $tag->storeId()
        ) {
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
        if ($user->can('authorize', 'tags.restore')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-tags.restore')
            && optional($user->store)->company_id === optional($tag->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-tags.restore')
            && $user->store_id === $tag->storeId()
        ) {
            return true;
        }

        return false;
    }

}
