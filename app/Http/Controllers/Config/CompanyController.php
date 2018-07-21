<?php
declare(strict_types=1);

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use Domain\UseCases\Config\UpdateCompany;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\View\View;

final class CompanyController extends Controller
{
    /** @var UpdateCompany */
    private $useCase;

    /**
     * @param  UpdateCompany $useCase
     * @param  Router $router
     * @return void
     */
    public function __construct(UpdateCompany $useCase, Router $router)
    {
        $this->middleware([
            'authenticate:web',
            sprintf('authorize:%s|%s', 'companies.*', 'companies.update'),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $id = auth()->user()->company->id;

        return view('config.company', [
            'row' => $this->useCase->get($id),
        ]);
    }

    /**
     * @param  SelfUpdateRequest $request
     */
    public function update(SelfUpdateRequest $request)
    {
        $id = auth()->user()->getAuthIdentifier();
        $inputs = $this->fill($request);

        $callback = function () use ($id, $inputs) {
            $this->useCase->excute($id, $inputs);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('config.profile');
    }

    /**
     * @param FormRequest $request
     * @return array
     */
    private function fill(FormRequest $request): array
    {
        $inputs = $request->validated();

        if (! $request->filled('password') ) {
            unset($inputs['password']);
        }

        return $inputs;
    }

}
