<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Http\Request;

final class IndexController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = $request->assign();

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
