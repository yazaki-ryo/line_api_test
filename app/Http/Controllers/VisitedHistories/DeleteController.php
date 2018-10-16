<?php
declare(strict_types=1);

namespace App\Http\Controllers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\VisitedHistories\DeleteVisitedHistory;
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
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.delete'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $visitedHistoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $visitedHistoryId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = session(config('session.name.current_store'));

        /** @var VisitedHistory $visitedHistoryId */
        $visitedHistory = $this->useCase->getVisitedHistory([
            'id' => $visitedHistoryId,
//             'customer.store_id' => $storeId,TODO XXX only current store
        ]);

        $this->authorize('delete', $visitedHistory);

        $callback = function () use ($user, $visitedHistory) {
            return $this->useCase->excute($user, $visitedHistory);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('customers.edit', $visitedHistory->customerId());
    }

}
