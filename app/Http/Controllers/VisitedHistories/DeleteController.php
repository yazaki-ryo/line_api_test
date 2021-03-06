<?php
declare(strict_types=1);

namespace App\Http\Controllers\VisitedHistories;

use App\Http\Controllers\Controller;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\VisitedHistories\DeleteVisitedHistory;
use Illuminate\Http\Request;

final class DeleteController extends Controller
{
    /** @var DeleteVisitedHistory */
    private $useCase;

    /**
     * @param  DeleteVisitedHistory $useCase
     * @return void
     */
    public function __construct(DeleteVisitedHistory $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.delete'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $visitedHistoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $visitedHistoryId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var VisitedHistory $visitedHistoryId */
        $visitedHistory = $this->useCase->getVisitedHistory([
            'id' => $visitedHistoryId,
            'store_id' => $storeId,
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
