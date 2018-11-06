<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\UpdateRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\Models\Reservation;
use Domain\UseCases\Reservations\UpdateReservation;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

final class UpdateController extends Controller
{
    /** @var UpdateReservation */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateReservation $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateReservation $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.reservations.update'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param int $reservationId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, int $reservationId)
    {
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Reservation $reservationId */
        $reservation = $this->useCase->getReservation([
            'id' => $reservationId,
            'store_id' => $storeId,
        ]);

        $this->authorize('select', $reservation);

        return view('reservations.edit', [
            'row' => $reservation,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $reservationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $reservationId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Reservation $reservationId */
        $reservation = $this->useCase->getReservation([
            'id' => $reservationId,
            'store_id' => $storeId,
        ]);

        $this->authorize('update', $reservation);

        $args = $request->validated();

        $callback = function () use ($user, $reservation, $args) {
            $this->useCase->excute($user, $reservation, $args);
        };

        if (! is_null($result = rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.reservation'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('reservations.index');
    }

}
