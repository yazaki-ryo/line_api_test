<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CurrentStore
{
    /** @var Auth */
    private $auth;

    /** @var string */
    private $sessionKeyName;


    /**
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->sessionKeyName = config('session.name.current_store');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if ($this->auth->check()) {
                /** @var User $user */
                $user = UserRepository::toModel($this->auth->user());

                if (is_numeric($value = request('store_id'))) {
                    $this->validate($user, (int)$value);
                    session()->put($this->sessionKeyName, (int)$value);

                } elseif (session()->has($this->sessionKeyName)) {
                    $this->validate($user, (int)session($this->sessionKeyName));
                } else {
                    session()->put($this->sessionKeyName, $user->storeId());
                }
            }
        } catch (AuthorizationException $e) {
            flash(__('The store does not exist or you do not have access.'), 'info');
            session()->put($this->sessionKeyName, $user->storeId());
        }

        return $next($request);
    }

    /**
     * @param User $user
     * @param int $value
     * @throws
     * @return void
     */
    private function validate(User $user, int $value): void
    {
        if (! Store::validateStoreId($user, $value)) {
            throw new AuthorizationException('Store ID is invalid.');
        }
    }
}
