<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\SearchRequest;
use Domain\Models\Reservation;
use Domain\Models\User;
use Domain\UseCases\Reservations\GetReservations;

final class IndexController extends Controller
{
    /** @var GetReservations */
    private $useCase;

    /**
     * @param  GetReservations $useCase
     * @return void
     */
    public function __construct(GetReservations $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.reservations.select'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param SearchRequest $request
     * @param Reservation $reservation
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Reservation $reservation)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        return view('reservations.index', [
            'rows' => $this->useCase->excute($user, $store, $args),
            'row' => $reservation,
            'tab' => count($args) ? 'index' : 'calender',
        ]);
    }

}
