<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Tags\UpdateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\UseCases\Customers\Tags\UpdateTags;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateController extends Controller
{
    /** @var UpdateTags */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateTags $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateTags $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.select'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, int $customerId)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);

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
