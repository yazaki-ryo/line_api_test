<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stores\UpdateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\User;
use Domain\UseCases\Settings\UpdateStore;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

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
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();

        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $callback = function () use ($user, $store, $args) {
            $this->useCase->excute($user, $store, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.stores'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.index');
    }

}
