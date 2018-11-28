<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SearchRequest;
use Domain\Models\User;
use Domain\UseCases\Users\GetUsers;

final class IndexController extends Controller
{
    /** @var GetUsers */
    private $useCase;

    /**
     * @param  GetUsers $useCase
     * @return void
     */
    public function __construct(GetUsers $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.select'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param SearchRequest $request
     * @param User $brankUser
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, User $brankUser)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        return view('users.index', [
            'rows' => $this->useCase->excute($user, $store, $args),
            'row' => $brankUser,
        ]);
    }

}
