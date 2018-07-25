<?php
declare(strict_types=1);

namespace App\Providers;

use App\Policies\CustomerPolicy;
use App\Services\Collection\DomainCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Models\Customer;
use Domain\Models\Permission;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Customer::class => CustomerPolicy::class,
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('authorize', function (\App\Eloquents\EloquentUser $user, ...$args): bool {
            $args = is_array($args) ? $args : [$args];

            /** @var DomainCollection $permissions */
            $permissions = cache()->remember(sprintf('permissions.%s', $user->id), 30, function () use ($user): DomainCollection {
                return app(GetUserInterface::class)->findById($user->getAuthIdentifier())->permissions();
            });

            foreach ($args as $permission) {
                if ($permissions->containsStrict(function (Permission $item) use ($permission) {
                    return $item->slug() === $permission;
                })) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Support\Providers\AuthServiceProvider::register()
     */
    public function register(): void
    {
        //
    }

}
