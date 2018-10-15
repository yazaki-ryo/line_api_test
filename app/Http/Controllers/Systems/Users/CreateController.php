<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Users;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Users\CreateUser;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateController extends Controller
{
    /** @var CreateUser */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateUser $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateUser $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.create'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param User $user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(User $user)
    {
        return view('users.add', [
            'row' => $user,
        ]);
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        $callback = function () use ($user, $args) {
            return $this->useCase->excute($user, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.users'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('users.edit', $result->id());
    }

}
