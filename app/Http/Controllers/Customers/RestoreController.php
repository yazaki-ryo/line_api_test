<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Domain\Models\User;
use Domain\UseCases\Customers\RestoreCustomer;
use Illuminate\Http\Request;

final class RestoreController extends Controller
{
    /** @var RestoreCustomer */
    private $useCase;

    /**
     * @param  RestoreCustomer $useCase
     * @return void
     */
    public function __construct(RestoreCustomer $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.restore'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $customerId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer([
            'id' => $customerId,
            'store_id' => $storeId,
            'trashed' => 'only',
        ]);

        $this->authorize('restore', $customer);

        $callback = function () use ($user, $customer) {
            return $this->useCase->excute($user, $customer);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.restored')]), 'success');
        return redirect()->route('customers.index');
    }

}
