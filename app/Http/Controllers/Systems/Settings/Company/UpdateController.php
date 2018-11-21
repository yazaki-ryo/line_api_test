<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Settings\Company;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Companies\UpdateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\User;
use Domain\UseCases\Settings\UpdateCompany;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateController extends Controller
{
    /** @var UpdateCompany */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateCompany $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateCompany $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.companies.update'))),
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

        return view('settings.company', [
            'row' => $this->useCase->getCompany($user),
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();

        $callback = function () use ($user, $args) {
            $this->useCase->excute($user, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.companies'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.company');
    }

}
