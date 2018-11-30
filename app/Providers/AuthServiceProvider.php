<?php
declare(strict_types=1);

namespace App\Providers;

use App\Policies;
use Domain\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        Models\Customer::class => Policies\CustomerPolicy::class,
        Models\Reservation::class => Policies\ReservationPolicy::class,
        Models\Tag::class => Policies\TagPolicy::class,
        Models\User::class => Policies\UserPolicy::class,
        Models\VisitedHistory::class => Policies\VisitedHistoryPolicy::class,
    ];

    /**
     * @param Request $request
     * @return void
     */
    public function boot(Request $request): void
    {
        $this->registerPolicies();

        Gate::define('authorize', function (Model $user, ...$args) use ($request): bool {
            /** @var Models\DomainModel $user */
            $user = $request->assign();
            $args = is_array($args) ? $args : [$args];

            foreach ($args as $arg) {
                if ($user->permissions()->containsStrict(function (Models\Permission $item) use ($arg) {
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
