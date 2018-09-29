<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
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
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.restore'))),
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
        $user = UserRepository::toModel($this->auth->user());

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer($customerId);

        $this->authorize('restore', $customer);

        $callback = function () use ($user, $customer) {
            return $this->useCase->excute($user, $customer);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.restored')]), 'success');
        return redirect()->route('customers');
    }

}
