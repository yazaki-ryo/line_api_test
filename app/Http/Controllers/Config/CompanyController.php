<?php
declare(strict_types=1);

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\UpdateRequest;
use Domain\Models\Company;
use Domain\Models\Prefecture;
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
            'authenticate:user',
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
            'row' => $this->useCase->getCompany($id),
            'prefectures' => $this->useCase->getPrefectures()->map(function (Prefecture $item) {
                return ['id' => $item->id(), 'name' => $item->name()];
            })->pluck('name', 'id'),
        ]);
    }

    /**
     * @param  UpdateRequest $request
     */
    public function excute(UpdateRequest $request)
    {
        $id = auth()->user()->company->id;
        $attributes = $this->fill($request);

        $callback = function () use ($id, $attributes) {
            $this->useCase->excute($id, Company::domainizeAttributes($attributes));
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('config.company');
    }

    /**
     * @param FormRequest $request
     * @return array
     */
    private function fill(FormRequest $request): array
    {
        $attributes = $request->validated();

        //

        return $attributes;
    }

}
