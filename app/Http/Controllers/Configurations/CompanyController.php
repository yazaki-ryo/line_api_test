<?php
declare(strict_types=1);

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\UpdateRequest;
use Domain\UseCases\Configurations\UpdateCompany;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CompanyController extends Controller
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
            'authenticate:user',
            sprintf('authorize:%s|%s', 'companies.*', 'companies.update'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view()
    {
        $id = optional($this->auth->user()->store)->company_id;

        return view('configurations.company', [
            'row' => $this->useCase->getCompany($id),
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $id = optional($this->auth->user()->store)->company_id;
        $args = $request->validated();

        $callback = function () use ($id, $args) {
            $this->useCase->excute($this->auth, $id, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.companies'), 'action' => __('elements.actions.updated')]), 'success');
        return redirect()->route('configurations.company');
    }

}
