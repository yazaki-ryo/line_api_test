<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

final class IndexController extends Controller
{
    /** @var Auth */
    private $auth;

    /**
     * @param  Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
        ]);

        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        /** @var Company $company */
        $company = $user->company();

        /** @var Store $store */
        $store = optional($company)->stores([
            'id' => $request->cookie(config('cookie.name.current_store')),
        ])->first();

        return view('settings.index', [
            'company' => $company,
            'store'   => $store,
            'user'    => $user,
        ]);
    }
}
