<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Customers;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Customers\CreateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\UseCases\Customers\CreateCustomer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateController extends Controller
{
    /** @var CreateCustomer */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateCustomer $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateCustomer $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.create'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param Customer $customer
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Customer $customer)
    {
        return view('customers.add', [
            'row' => $customer,
        ]);
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();

        $callback = function () use ($user, $args) {
            return $this->useCase->excute($user, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('customers.edit', $result->id());
    }

}
