<?php
declare(strict_types=1);

namespace App\Http\Controllers\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitedHistories\UpdateRequest;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\VisitedHistories\UpdateVisitedHistory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

final class UpdateController extends Controller
{
    /** @var UpdateVisitedHistory */
    private $useCase;

    /**
     * @param  UpdateVisitedHistory $useCase
     * @return void
     */
    public function __construct(UpdateVisitedHistory $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.update'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $visitedHistoryId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, int $visitedHistoryId)
    {
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var VisitedHistory $visitedHistoryId */
        $visitedHistory = $this->useCase->getVisitedHistory([
            'id' => $visitedHistoryId,
            'store_id' => $storeId,
        ]);

        $this->authorize('select', $visitedHistory);

        return view('visited_histories.edit', [
            'row' => $visitedHistory,
            'store_seats' => $visitedHistory->customer()->store()->seats(),
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
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var VisitedHistory $visitedHistoryId */
        $visitedHistory = $this->useCase->getVisitedHistory([
            'id' => $visitedHistoryId,
            'store_id' => $storeId,
        ]);

        $this->authorize('update', $visitedHistory);

        $args = $request->validated();

        /** @var UploadedFile $file */
        $file = $request->file('attachment');

        $callback = function () use ($user, $visitedHistory, $args, $file) {
            $this->useCase->excute($user, $visitedHistory, $args, $file);
        };

        if (! is_null($result = rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('visited_histories.edit', $visitedHistory->id());
    }

}
