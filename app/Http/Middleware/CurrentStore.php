<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

final class CurrentStore
{
    /** @var string */
    private $keyName;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->keyName = config('cookie.name.current_store');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null($user = $request->assign())) {
            return $next($request);
        }

        try {
            if (is_numeric($value = $request->query('store_id'))) {
                $this->validate($user, (int)$value);

            } elseif (is_numeric($value = $request->cookie($this->keyName))) {
                $this->validate($user, (int)$value);
                return $next($request);
            } else {
                $value = $user->storeId();
            }
        } catch (AuthorizationException $e) {
            flash(__('The store does not exist or you do not have access.'), 'warning');
            $request->session()->reflash();
            $value = $user->storeId();
        }

        Cookie::queue(Cookie::forever($this->keyName, (int)$value));

        return redirect($request->path());
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
