<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\UpdateRequest;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\Customers\UpdateCustomer;
use Domain\UseCases\VisitedHistories\UpdateVisitedHistory;
use Illuminate\Http\Request;

final class UpdateController extends Controller
{
    /** @var UpdateCustomer */
    private $useCase;

    /**
     * @param  UpdateCustomer $useCase
     * @return void
     */
    public function __construct(UpdateCustomer $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.update'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param VisitedHistory $visitedHistory
     * @param int $customerId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, VisitedHistory $visitedHistory, UpdateVisitedHistory $updateVisitedHistory, int $customerId)
    {
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer([
            'id' => $customerId,
            'store_id' => $storeId,
        ]);

        $this->authorize('update', $customer);

        return view('customers.edit', [
            'row' => $customer,
            'tags' => $customer->store()->tags()->groupBy(function ($item) {
                return $item->label();
            }),
            'tagIds' => $customer->tags(),
            'visitedHistories' => $customer->visitedHistories(),
            'reservations' => $customer->reservations(),
            'brankHistory' => $visitedHistory,
            'updateVisitedHistory' => $updateVisitedHistory
        ]);
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $customerId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer([
            'id' => $customerId,
            'store_id' => $storeId,
        ]);
        $args = $request->validated();

        $this->authorize('update', $customer);

        $callback = function () use ($user, $customer, $args) {
            $this->useCase->excute($user, $customer, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('customers.edit', $customerId);
    }

}
