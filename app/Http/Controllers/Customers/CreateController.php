<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CreateRequest;
use Domain\Models\Customer;
use Domain\UseCases\Customers\CreateCustomer;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class CreateController extends Controller
{
    /** @var CreateCustomer */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateCustomer $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateCustomer $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.create'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
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
        $args = $request->validated();

        $callback = function () use ($args) {
            return $this->useCase->excute($this->auth, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('customers.edit', $result->id());
    }

}
