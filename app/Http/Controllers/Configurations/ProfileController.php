<?php
declare(strict_types=1);

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Configurations\UpdateProfile;
use Illuminate\Http\UploadedFile;
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
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        return view('configurations.profile', [
            'row' => $user,
        ]);
    }

    /**
     * @param SelfUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SelfUpdateRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        /** @var UploadedFile $file */
        if (! is_null($file = $request->file('avatar'))) {
            $args['avatar_path'] = sprintf('images/avatars/users/%s', $user->id());
            $args['avatar_name'] = sprintf('%s_%s_%s', time(), str_random(16), $file->getClientOriginalName());
        }

        $callback = function () use ($user, $args) {
            $this->useCase->excute($user, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        if (! is_null($file)) {
            $file->storeAs($args['avatar_path'], $args['avatar_name'], 'public');
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.users'), 'action' => __('elements.actions.updated')]), 'success');
        return redirect()->route('configurations.profile');
    }

}
