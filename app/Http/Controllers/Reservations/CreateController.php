<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\CreateRequest;
use App\Repositories\UserRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\Models\Reservation;
use Domain\UseCases\Reservations\CreateReservation;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateController extends Controller
{
    /** @var CreateReservation */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateReservation $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateReservation $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.reservations.create'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = session(config('session.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $args = $request->validated();

        $callback = function () use ($user, $store, $args) {
            return $this->useCase->excute($user, $store, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.reservation'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('reservations');
    }

}
