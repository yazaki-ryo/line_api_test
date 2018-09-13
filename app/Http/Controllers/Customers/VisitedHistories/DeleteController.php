<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\Customers\VisitedHistories\DeleteVisitedHistory;
use Illuminate\Contracts\Auth\Factory as Auth;

final class DeleteController extends Controller
{
    /** @var DeleteVisitedHistory */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  DeleteVisitedHistory $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(DeleteVisitedHistory $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.visited_histories.delete'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $customerId
     * @param int $visitedHistory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $customerId, int $visitedHistory)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        /** @var Customer $customer */
        $customer = $this->useCase->getCustomer($customerId);

        /** @var VisitedHistory $visitedHistory */
        $visitedHistory = $this->useCase->getVisitedHistory($customer, $visitedHistory);

        $this->authorize('delete', $visitedHistory);

        $callback = function () use ($user, $visitedHistory) {
            return $this->useCase->excute($user, $visitedHistory);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('customers.edit', $customer->id());
    }

}
