<?php
declare(strict_types=1);

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use App\Repositories\UserRepository;
use Domain\UseCases\Configurations\UpdateProfile;
use Illuminate\Contracts\Auth\Factory as Auth;

final class ProfileController extends Controller
{
    /** @var UpdateProfile */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateProfile $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateProfile $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view()
    {
        return view('configurations.profile', [
            'row' => UserRepository::toModel($this->auth->user()),
        ]);
    }

    /**
     * @param SelfUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SelfUpdateRequest $request)
    {
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        $callback = function () use ($user, $args) {
            $this->useCase->excute($user, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.users'), 'action' => __('elements.actions.updated')]), 'success');
        return redirect()->route('configurations.profile');
    }

}
