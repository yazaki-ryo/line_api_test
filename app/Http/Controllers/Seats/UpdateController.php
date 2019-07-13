<?php
declare(strict_types=1);

namespace App\Http\Controllers\Seats;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seats\UpdateRequest;
use Domain\Models\Seat;
use Domain\Models\User;
use Domain\UseCases\Seats\UpdateSeat;
use Illuminate\Http\Request;

final class UpdateController extends Controller
{
    /** @var UpdateSeat */
    private $useCase;

    /**
     * @param  UpdateSeat $useCase
     * @return void
     */
    public function __construct(UpdateSeat $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $seatId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, int $seatId)
    {
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Seat $seat */
        $seat = $this->useCase->getSeat([
            'id' => $seatId,
            'store_id' => $storeId,
        ]);

        return view('seats.edit', [
            'row' => $seat,
        ]);
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $seatId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $seatId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Seat $seat */
        $seat = $this->useCase->getSeat([
            'id' => $seatId,
            'store_id' => $storeId,
        ]);

        $args = $request->validated();

        $callback = function () use ($user, $seat, $args) {
            $this->useCase->excute($user, $seat, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.seats'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('seats.index');
    }

}
