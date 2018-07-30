<?php
declare(strict_types=1);

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use Domain\UseCases\Config\UpdateProfile;
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
        $id = $this->auth->user()->getAuthIdentifier();

        return view('config.profile', [
            'row' => $this->useCase->getUser($id),
        ]);
    }

    /**
     * @param SelfUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SelfUpdateRequest $request)
    {
        $id = $this->auth->user()->getAuthIdentifier();
        $args = $request->validated();

        $callback = function () use ($id, $args) {
            $this->useCase->excute($this->auth, $id, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.users'), 'action' => __('elements.actions.updated')]), 'success');
        return redirect()->route('config.profile');
    }

}
