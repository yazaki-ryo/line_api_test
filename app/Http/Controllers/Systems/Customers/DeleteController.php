<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Customers;

use App\Http\Controllers\Systems\Controller;
use App\Repositories\EloquentRepository;
use Domain\Models\User;
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
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.delete'))),
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
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer($customerId);

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
