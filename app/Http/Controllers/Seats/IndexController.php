<?php
declare(strict_types=1);

namespace App\Http\Controllers\Seats;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seats\SearchRequest;
use Domain\Models\Seat;
use Domain\Models\User;
use Domain\UseCases\Seats\GetSeats;

final class IndexController extends Controller
{
    /** @var GetSeat */
    private $useCase;

    /**
     * @param  GetSeat $useCase
     * @return void
     */
    public function __construct(GetSeats $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.stores.select'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param SearchRequest $request
     * @param Seat $seat
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Seat $seat)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        return view('seats.index', [
            'rows' => $this->useCase->excute($user, $store, $args),
            'row' => $seat,
        ]);
    }

}
