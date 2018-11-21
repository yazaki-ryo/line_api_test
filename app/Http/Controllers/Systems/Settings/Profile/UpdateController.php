<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Settings\Profile;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\User;
use Domain\UseCases\Settings\UpdateProfile;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\UploadedFile;

final class UpdateController extends Controller
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
            sprintf('authenticate:%s', $this->guard),
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
        $user = EloquentRepository::assign($this->auth->user(), true);

        return view('settings.profile', [
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
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();

        /** @var UploadedFile $file */
        $file = $request->file('avatar');

        $callback = function () use ($user, $args, $file) {
            $this->useCase->excute($user, $args, $file);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.user'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.profile');
    }

}
