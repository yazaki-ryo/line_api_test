<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Domain\Contracts\Users\GetUserInterface;
use Domain\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
//         'App\SomeModel::class' => 'App\Policies\SomeModelPolicy::class',
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('authorize', function ($user, ...$args): bool {
            $args = is_array($args) ? $args : [$args];
            $permissions = app(GetUserInterface::class)->findById($user->id)->permissions();

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
}
