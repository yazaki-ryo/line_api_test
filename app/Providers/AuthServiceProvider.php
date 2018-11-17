<?php
declare(strict_types=1);

namespace App\Providers;

use App\Policies\CustomerPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use App\Policies\VisitedHistoryPolicy;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Domain\Models\Customer;
use Domain\Models\Permission;
use Domain\Models\Reservation;
use Domain\Models\Tag;
use Domain\Models\User;
use Domain\Models\VisitedHistory;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Customer::class => CustomerPolicy::class,
        Reservation::class => ReservationPolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
        VisitedHistory::class => VisitedHistoryPolicy::class,
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('authorize', function (Model $user, ...$args): bool {
            $args = is_array($args) ? $args : [$args];

            /**
             * TODO XXX
             */
            $user = UserRepository::toModel($user);

            foreach ($args as $arg) {
                if ($user->permissions()->containsStrict(function (Permission $item) use ($arg) {
                    return $item->slug() === (string)$arg;
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
