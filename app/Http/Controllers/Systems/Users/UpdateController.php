<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Users;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Users\UpdateUser;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateController extends Controller
{
    /** @var UpdateUser */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateUser $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateUser $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:administrator',
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.update'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $userId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(int $userId)
    {
        /** @var User $targetUser */
        $targetUser = $this->useCase->getUser($userId);

        $this->authorize('update', $targetUser);

        return view('users.edit', [
            'row' => $targetUser,
        ]);
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $userId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        /** @var User $targetUser */
        $targetUser = $this->useCase->getUser($userId);
        $args = $request->validated();

        $this->authorize('update', $targetUser);

        $callback = function () use ($user, $targetUser, $args) {
            $this->useCase->excute($user, $targetUser, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.users'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('users.edit', $userId);
    }

}
