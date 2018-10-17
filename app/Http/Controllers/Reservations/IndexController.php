<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\SearchRequest;
use App\Repositories\UserRepository;
use Domain\Models\Reservation;
use Domain\Models\User;
use Domain\UseCases\Reservations\GetReservations;
use Illuminate\Contracts\Auth\Factory as Auth;

final class IndexController extends Controller
{
    /** @var GetReservations */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  GetReservations $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(GetReservations $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.reservations.select'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param SearchRequest $request
     * @param Reservation $reservation
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Reservation $reservation)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();
        $storeId = session(config('session.name.current_store'));

        return view('reservations.index', [
            'rows' => $this->useCase->excute($user, array_merge($args, [
                'store_id' => $storeId,
            ])),
            'row' => $reservation,
        ]);
    }

}
