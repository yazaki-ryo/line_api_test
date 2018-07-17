<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Domain\Contracts\Users\GetUserInterface;
use Closure;
use Domain\Models\Permission;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Validation\UnauthorizedException;

class Authorize
{
    /** @var Auth */
    private $auth;

    /** @var GetUserInterface */
    private $usersService;

    /**
     * @param Auth $auth
     */
    public function __construct(Auth $auth, GetUserInterface $usersService)
    {
        $this->auth = $auth;
        $this->usersService = $usersService;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $arg
     * @return mixed
     */
    public function handle($request, Closure $next, string $arg = '')
    {
        $id = $this->auth->user()->id;
        $permissions = $this->usersService->findById($id)->permissions();

        foreach (explode('|', $arg) as $permission) {
            if ($permissions->containsStrict(function (Permission $item) use ($permission) {
                return $item->slug() === $permission;
            })) {
                return $next($request);
            }
        }

        throw new UnauthorizedException('This action is Unauthorized.', 403);
    }
}
