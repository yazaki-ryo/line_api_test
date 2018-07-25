<?php
declare(strict_types=1);

namespace App\Policies;

use App\Eloquents\EloquentUser;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Models\Customer;
use Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class CustomerPolicy
{
    use HandlesAuthorization;

    /** @var GetUserInterface */
    private $getUserService;

    /** @var User */
    private $user;

    /**
     * @param GetUserInterface $getUserService
     * @return void
     */
    public function __construct(GetUserInterface $getUserService)
    {
        $this->getUserService = $getUserService;
    }

    /**
     * @param  EloquentUser  $user
     * @param  string  $ability
     * @return boolean|null
     */
    public function before(EloquentUser $user, string $ability): ?bool
    {
        $this->user = $this->getUserService->findById($user->getAuthIdentifier());

        return null;
    }

    /**
     * @param  EloquentUser  $user
     * @return bool
     */
    public function index(EloquentUser $user): bool
    {
        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function get(EloquentUser $user, Customer $customer): bool
    {
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
        if (optional($this->user->role())->slugs('company-admin')
            && optional($this->user->company())->id() === optional(optional($customer->store())->company())->id())
        {
            return true;
        } elseif (optional($this->user->role())->slugs('store-user')
            && optional($this->user->store())->id() === optional($customer->store())->id())
        {
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
        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Customer  $customer
     * @return bool
     */
    public function restore(EloquentUser $user, Customer $customer): bool
    {
        return false;
    }

}
