<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\UpdateRequest;
use Domain\Models\Customer;
use Domain\UseCases\Customers\UpdateCustomer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\View\View;

final class UpdateController extends Controller
{
    /** @var UpdateCustomer */
    private $useCase;

    /**
     * @param  UpdateCustomer $useCase
     * @param  Router $router
     * @return void
     */
    public function __construct(UpdateCustomer $useCase, Router $router)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.update'),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param int $customerId
     * @return View
     */
    public function view(int $customerId): View
    {
        $customer = $this->useCase->getCustomer($customerId);

        $this->authorize('update', $customer);

        return view('customers.edit', [
            'row'         => $this->useCase->getCustomer($customerId),
            'prefectures' => $this->useCase->getPrefectures()->pluckNamesByIds(),
            'sexes'       => $this->useCase->getSexes(),
        ]);
    }

    /**
     * @param int $customerId
     * @param  UpdateRequest $request
     */
    public function excute(UpdateRequest $request, int $customerId)
    {
        $attributes = $this->fill($request);

        $callback = function () use ($customerId, $attributes) {
            $this->useCase->excute($customerId, Customer::domainizeAttributes($attributes));
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('customers.edit', $customerId);
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
