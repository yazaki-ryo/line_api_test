<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CreateRequest;
use App\Repositories\UserRepository;
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
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.visited_histories.create'),
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
        return view('customers.visited_histories.add', [
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
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        $callback = function () use ($user, $args) {
            return $this->useCase->excute($user, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit') . __('elements.words.information'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('customers.edit', $result->id());
    }

}
