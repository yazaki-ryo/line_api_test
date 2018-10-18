<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SearchRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Users\GetUsers;
use Illuminate\Contracts\Auth\Factory as Auth;

final class IndexController extends Controller
{
    /** @var GetUsers */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  GetUsers $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(GetUsers $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.select'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param SearchRequest $request
     * @param User $brankUser
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, User $brankUser)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();
        $storeId = session(config('session.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        return view('users.index', [
            'rows' => $this->useCase->excute($user, $store, $args),
            'row' => $brankUser,
        ]);
    }

}
