<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Users;

use App\Http\Controllers\Systems\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Users\RestoreUser;
use Illuminate\Contracts\Auth\Factory as Auth;

final class RestoreController extends Controller
{
    /** @var RestoreUser */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  RestoreUser $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(RestoreUser $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.restore'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $userId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        /** @var User $user */
        $targetUser = $this->useCase->getUser($userId);

        $this->authorize('restore', $targetUser);

        $callback = function () use ($user, $targetUser) {
            return $this->useCase->excute($user, $targetUser);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.users'), 'action' => __('elements.words.restored')]), 'success');
        return redirect()->route('users.index');
    }

}
