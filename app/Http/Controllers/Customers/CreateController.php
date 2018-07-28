<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CreateRequest;
use Domain\Models\Customer;
use Domain\UseCases\Customers\CreateCustomer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\View\View;

final class CreateController extends Controller
{
    /** @var CreateCustomer */
    private $useCase;

    /**
     * @param  CreateCustomer $useCase
     * @return void
     */
    public function __construct(CreateCustomer $useCase)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.create'),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @return View
     */
    public function view(Customer $customer): View
    {
        return view('customers.add', [
            'row' => $customer,
        ]);
    }

    /**
     * @param  CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $attributes = $this->fill($request);

        $callback = function () use ($attributes) {
            return $this->useCase->excute(Customer::domainizeAttributes($attributes));
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('customers.edit', $result->id());
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
