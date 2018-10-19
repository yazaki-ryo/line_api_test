<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations\VisitedHistories;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\Customer;
use Domain\Models\Reservation;
use Domain\Models\User;
use Domain\Models\VisitedHistory;
use Domain\UseCases\Reservations\VisitedHistories\CreateVisitedHistory;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateController extends Controller
{
    /** @var CreateVisitedHistory */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateVisitedHistory $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateVisitedHistory $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.visited_histories.create'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param  int $reservationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(VisitedHistory $visitedHistory, int $reservationId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = session(config('session.name.current_store'));

        /** @var Reservation $reservation */
        $reservation = $this->useCase->getReservation([
            'id' => $reservationId,
            'store_id' => $storeId,
        ]);

        /** @var Customer $customer */
        if (is_null($customer = $reservation->customer())) {
            flash(__('Customer information is not associated with reservation information.'), 'info');
            return redirect()->route('reservations');
        }

        if (! is_null($reservation->visitedHistory())) {
            flash(__('Visiting information has already been registered.'), 'info');
            return redirect()->route('reservations');
        }

        $this->authorize('create', [
            $visitedHistory,
            $customer,
        ]);

        $callback = function () use ($user, $customer, $reservation) {
            $this->useCase->excute($user, $customer, $reservation);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.visit'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('reservations');
    }

}
