<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\UpdateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\Company;
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
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();

        /** @var Company $company */
        $company = $this->useCase->getCompany($user);

        $callback = function () use ($user, $company, $args) {
            $this->useCase->excute($user, $company, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.companies'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.index');
    }

}
