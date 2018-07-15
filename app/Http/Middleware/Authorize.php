<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Validation\UnauthorizedException;

class Authorize
{
    private $auth;

    /**
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permissions
     * @return mixed
     */
    public function handle($request, Closure $next, string $permissions = '')
    {
        foreach (explode('|', $permissions) as $permission) {
            if ($this->auth->user()->permissions->containsStrict('slug', $permission)) {
                return $next($request);
            }
        }

        throw new UnauthorizedException('This action is Unauthorized.', 403);
    }
}
