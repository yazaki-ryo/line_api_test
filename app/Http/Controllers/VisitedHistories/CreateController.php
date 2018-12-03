<?php
declare(strict_types=1);

namespace App\Http\Controllers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitedHistories\CreateRequest;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\VisitedHistories\CreateVisitedHistory;

final class CreateController extends Controller
{
    /** @var CreateVisitedHistory */
    private $useCase;

    /**
     * @param  CreateVisitedHistory $useCase
     * @return void
     */
    public function __construct(CreateVisitedHistory $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.create'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param CreateRequest $request
     * @param VisitedHistory $visitedHistory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request, VisitedHistory $visitedHistory)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer([
            'id' => $request->get('customer_id'),
            'store_id' => $storeId,
        ]);

        $this->authorize('create', [
            $visitedHistory,
            $customer,
        ]);

        $args = $request->validated();

        $callback = function () use ($user, $customer, $args) {
            return $this->useCase->excute($user, $customer, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('customers.edit', $customer->id());
    }

}
