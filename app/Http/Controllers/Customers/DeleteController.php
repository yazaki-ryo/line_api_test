<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\DeleteMultipleRequest;
use Domain\Models\User;
use Domain\UseCases\Customers\DeleteCustomer;
use Illuminate\Http\Request;

final class DeleteController extends Controller
{
    /** @var DeleteCustomer */
    private $useCase;

    /**
     * @param  DeleteCustomer $useCase
     * @return void
     */
    public function __construct(DeleteCustomer $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.delete'))),
        ]);

        $this->useCase = $useCase;
    }
    
    public function deleteMultiple(DeleteMultipleRequest $request) {
        $user = $request->assign();
        $args = $request->validated();
        
        $callback = function () use ($user, $args) {
            return $this->useCase->deleteMultiple($user, $args['target_customers']);
        };
        
        if (!rescue($callback, false)) {
            flash(__('An internal error occurred. Please contact the administrator.'), 
                    'danger');
            return back();
        }

        flash(__('The :name information was :action.', [
                    'name' => __('elements.words.customers'), 
                    'action' => __('elements.words.deleted')]), 
                'info');
        return redirect()->route('customers.index');
    }

    /**
     * @param Request $request;
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
        ]);

        $this->authorize('delete', $customer);

        $callback = function () use ($user, $customer) {
            return $this->useCase->excute($user, $customer);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('customers.index');
    }

}
