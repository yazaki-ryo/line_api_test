<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Tags\UpdateRequest;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\UseCases\Customers\Tags\UpdateTags;

final class UpdateController extends Controller
{
    /** @var UpdateTags */
    private $useCase;

    /**
     * @param  UpdateTags $useCase
     * @return void
     */
    public function __construct(UpdateTags $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.select'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, int $customerId)
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
