<?php
declare(strict_types=1);

namespace App\Http\Controllers\PrintHistories;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrintHistories\DeleteMultipleRequest;
use Domain\Models\User;
use Domain\Models\PrintHistory;
use Domain\UseCases\PrintHistories\DeletePrintHistory;
use Illuminate\Http\Request;

final class DeleteController extends Controller
{
    /** @var DeletePrintHistory */
    private $useCase;

    /**
     * @param  DeletePrintHistory $useCase
     * @return void
     */
    public function __construct(DeletePrintHistory $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.delete'))),
        ]);

        $this->useCase = $useCase;
    }

    public function deleteMultiple(DeleteMultipleRequest $request) {
        $user = $request->assign();
        $args = $request->validated();

        $printHistory = $this->useCase->getPrintHistory([
            'id' => current($args['target_print_histories']),
        ]);
        \Log::debug( 'customerId :: ' . $printHistory->customerId());

        $callback = function () use ($user, $args) {
            return $this->useCase->deleteMultiple($user, $args['target_print_histories']);
        };
        
        if (!rescue($callback, false)) {
            flash(__('An internal error occurred. Please contact the administrator.'), 
                    'danger');
            return back();
        }

        flash(__('The :name information was :action.', [
                    'name' => __('elements.words.print_history'), 
                    'action' => __('elements.words.deleted')]), 
                'info');
        return redirect()->route('customers.edit', $printHistory->customerId());
        //return redirect()->route('customers.index');
    }

    /**
     * @param Request $request
     * @param int $printHistoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $printHistoryId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var printHistoryId $printHistoryId */
        $printHistory = $this->useCase->getPrintHistory([
            'id' => $printHistoryId,
            'store_id' => $storeId,
        ]);

        $this->authorize('delete', $printHistory);

        $callback = function () use ($user, $printHistory) {
            return $this->useCase->excute($user, $printHistory);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.print_history'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('customers.edit', $printHistory->customerId());
    }

}
