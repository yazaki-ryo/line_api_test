<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\SearchRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Customers\GetCustomers;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

final class IndexController extends Controller
{
    /** @var GetCustomers */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  GetCustomers $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(GetCustomers $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.select'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param SearchRequest $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        return view('customers.index', [
            'rows' => $this->useCase->excute($user, $args),
            'tags' => $user->store()->tags()->groupBy(function ($item) {
                return $item->label();
            }),
            'printSettings' => $this->printSettings($request),
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function printSettings(Request $request): array
    {
        $cookies = [];
        for ($i = 1; $i < 4; $i++) {
            if (! is_null($cookie = $request->cookie(sprintf('settings_printings_%s', $i)))) {
                $cookies[$i] = (json_decode($cookie))->name;
            }
        }
        return $cookies;
    }

}
