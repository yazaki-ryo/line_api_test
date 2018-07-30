<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Domain\UseCases\Customers\RestoreCustomer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class RestoreController extends Controller
{
    /** @var RestoreCustomer */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  RestoreCustomer $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(RestoreCustomer $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.restore'),
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

        $this->authorize('restore', $customer);

        $callback = function () use ($customerId) {
            return $this->useCase->excute($this->auth, $customerId);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.customers'), 'action' => __('elements.actions.restored')]), 'success');
        return redirect()->route('customers');
    }

}
