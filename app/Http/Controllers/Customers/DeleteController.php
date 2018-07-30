<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Domain\UseCases\Customers\DeleteCustomer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class DeleteController extends Controller
{
    /** @var DeleteCustomer */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  DeleteCustomer $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(DeleteCustomer $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.delete'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $customerId)
    {
        $customer = $this->useCase->getCustomer($customerId);

        $this->authorize('delete', $customer);

        $callback = function () use ($customerId) {
            return $this->useCase->excute($this->auth, $customerId);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name'   => __('elements.resources.customers'), 'action' => __('elements.actions.updated')]), 'success');
        return redirect()->route('customers');
    }

}
