<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authorize
{
    /** @var Auth */
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
     * @param  string  $args
     * @return mixed
     */
    public function handle($request, Closure $next, string $args = '')
    {
        if ($this->auth->user()->can('authorize', explode('|', $args))) {
            return $next($request);
        }

        abort(403, 'This action is Unauthorized.');
    }
}
