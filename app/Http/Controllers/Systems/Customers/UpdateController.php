<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Customers;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Customers\UpdateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\UseCases\Customers\UpdateCustomer;
use Illuminate\Contracts\Auth\Factory as Auth;

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
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.update'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $customerId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(int $customerId)
    {
        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer($customerId);

        $this->authorize('update', $customer);

        return view('customers.edit', [
            'row' => $customer,
            'tags' => $customer->store()->tags()->groupBy(function ($item) {
                return $item->label();
            }),
            'tagIds' => $customer->tags(),
            'visitedHistories' => $customer->visitedHistories(),

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
        $user = EloquentRepository::assign($this->auth->user(), true);

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer($customerId);
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
