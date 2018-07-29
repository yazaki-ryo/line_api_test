<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\UpdateRequest;
use Domain\UseCases\Customers\UpdateCustomer;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class UpdateController extends Controller
{
    /** @var UpdateCustomer */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateCustomer $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateCustomer $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.update'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
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
            'row' => $this->useCase->getCustomer($customerId),
        ]);
    }

    /**
     * @param int $customerId
     * @param  UpdateRequest $request
     */
    public function update(UpdateRequest $request, int $customerId)
    {
        $args = $request->validated();

        $callback = function () use ($customerId, $args) {
            $this->useCase->excute($this->auth, $customerId, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('customers.edit', $customerId);
    }

}
