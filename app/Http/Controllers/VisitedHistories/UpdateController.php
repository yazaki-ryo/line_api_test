<?php
declare(strict_types=1);

namespace App\Http\Controllers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitedHistories\UpdateRequest;
use App\Repositories\UserRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\VisitedHistories\UpdateVisitedHistory;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateController extends Controller
{
    /** @var UpdateVisitedHistory */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateVisitedHistory $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateVisitedHistory $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.update'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $visitedHistoryId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(int $visitedHistoryId)
    {
        /** @var VisitedHistory $visitedHistoryId */
        $visitedHistory = $this->useCase->getVisitedHistory($visitedHistoryId);

        $this->authorize('select', $visitedHistory);

        return view('visited_histories.edit', [
            'row' => $visitedHistory,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $visitedHistoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $visitedHistoryId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        /** @var VisitedHistory $visitedHistory */
        $visitedHistory = $this->useCase->getVisitedHistory($visitedHistoryId);

        $this->authorize('update', $visitedHistory);

        $args = $request->validated();

        $callback = function () use ($user, $visitedHistory, $args) {
            $this->useCase->excute($user, $visitedHistory, $args);
        };

        if (! is_null($result = rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('customers.edit', $visitedHistory->customerId());
    }

}
