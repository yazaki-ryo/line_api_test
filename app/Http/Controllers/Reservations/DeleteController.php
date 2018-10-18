<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\Models\Reservation;
use Domain\UseCases\Reservations\DeleteReservation;
use Illuminate\Contracts\Auth\Factory as Auth;

final class DeleteController extends Controller
{
    /** @var DeleteReservation */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  DeleteReservation $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(DeleteReservation $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.reservations.delete'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $reservationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $reservationId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = session(config('session.name.current_store'));

        /** @var Reservation $reservationId */
        $reservation = $this->useCase->getReservation([
            'id' => $reservationId,
            'store_id' => $storeId,
        ]);

        $this->authorize('delete', $reservation);

        $callback = function () use ($user, $reservation) {
            return $this->useCase->excute($user, $reservation);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.reservation'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('reservations');
    }

}
