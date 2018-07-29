<?php
declare(strict_types=1);

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\UpdateRequest;
use Domain\UseCases\Config\UpdateCompany;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

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
     * @return View
     */
    public function view(): View
    {
        $id = optional($this->auth->user()->company)->id;

        return view('config.company', [
            'row' => $this->useCase->getCompany($id),
        ]);
    }

    /**
     * @param  UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $id = optional($this->auth->user()->company)->id;
        $args = $request->validated();

        $callback = function () use ($id, $args) {
            $this->useCase->excute($this->auth, $id, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('config.company');
    }

}
