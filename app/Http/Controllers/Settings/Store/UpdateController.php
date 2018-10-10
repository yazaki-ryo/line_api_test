<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stores\UpdateRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Settings\UpdateStore;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateController extends Controller
{
    /** @var UpdateStore */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateStore $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateStore $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.stores.update'))),
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

        return view('settings.store', [
            'row' => $this->useCase->getStore($user),
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        $callback = function () use ($user, $args) {
            $this->useCase->excute($user, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.stores'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.store');
    }

}
