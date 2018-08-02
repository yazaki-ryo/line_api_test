<?php
declare(strict_types=1);

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stores\UpdateRequest;
use Domain\UseCases\Configurations\UpdateStore;
use Illuminate\Contracts\Auth\Factory as Auth;

final class StoreController extends Controller
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
            'authenticate:user',
            sprintf('authorize:%s|%s', 'stores.*', 'stores.update'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view()
    {
        $id = $this->auth->user()->store_id;

        return view('configurations.store', [
            'row' => $this->useCase->getStore($id),
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $id = $this->auth->user()->store_id;
        $args = $request->validated();

        $callback = function () use ($id, $args) {
            $this->useCase->excute($this->auth, $id, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.stores'), 'action' => __('elements.actions.updated')]), 'success');
        return redirect()->route('configurations.store');
    }

}
