<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\SearchRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\UseCases\Customers\GetCustomers;
use Illuminate\Contracts\Auth\Factory as Auth;

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
     * @param Customer $customer
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Customer $customer)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        return view('customers.index', [
            'rows' => $this->useCase->excute($user, $store, $args),
            'row'  => $customer,
            'printSettings' => $user->printSettings()->domainizePrintSettings(true),
            'tags' => $user->company()->tags([
                'store_id' => $storeId,
            ])->groupBy(function ($item) {
                return $item->label();
            }),
        ]);
    }

}
