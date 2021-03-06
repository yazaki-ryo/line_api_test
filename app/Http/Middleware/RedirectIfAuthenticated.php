<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

final class RedirectIfAuthenticated
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $name = 'home';

            if ($guard === 'administrator') {
                $name = sprintf('systems.%s', $name);
            }

            return redirect()->guest(route($name));
        }

        return $next($request);
    }
}
