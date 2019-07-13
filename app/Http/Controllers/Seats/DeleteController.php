<?php
declare(strict_types=1);

namespace App\Http\Controllers\Seats;

use App\Http\Controllers\Controller;
use Domain\Models\User;
use Domain\UseCases\Seats\DeleteSeat;
use Illuminate\Http\Request;

final class DeleteController extends Controller
{
    /** @var DeleteSeat */
    private $useCase;

    /**
     * @param  Delete $useCase
     * @return void
     */
    public function __construct(DeleteSeat $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $seatId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $seatId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Seat $seat */
        $seat = $this->useCase->getSeat([
            'id' => $seatId,
            'store_id' => $storeId,
        ]);

        $callback = function () use ($user, $seat) {
            return $this->useCase->excute($user, $seat);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.seats'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('seats.index');
    }

}
