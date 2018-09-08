<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\VisitedHistories\CreateRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\Customers\CreateVisitedHistory;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateController extends Controller
{
    /** @var CreateVisitedHistory */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateVisitedHistory $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateVisitedHistory $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.visited_histories.create'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param VisitedHistory $visitedHistory
     * @param int $customerId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(VisitedHistory $visitedHistory, int $customerId)
    {
        $customer = $this->useCase->getCustomer($customerId);

        return view('customers.visited_histories.add', [
            'row'        => $visitedHistory,
            'customerId' => $customer->id(),
        ]);
    }

    /**
     * @param CreateRequest $request
     * @param int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateRequest $request, int $customerId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $customer = $this->useCase->getCustomer($customerId);
        $args = $request->validated();

        $callback = function () use ($user, $customer, $args) {
            return $this->useCase->excute($user, $customer, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('customers.edit', $customerId);
    }

}
