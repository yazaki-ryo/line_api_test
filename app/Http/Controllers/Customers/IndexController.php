<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\SearchRequest;
use Domain\Models\Customer;
use Domain\Models\User;
use Domain\UseCases\Customers\GetCustomers;

final class IndexController extends Controller
{
    /** @var GetCustomers */
    private $useCase;

    /**
     * @param  GetCustomers $useCase
     * @return void
     */
    public function __construct(GetCustomers $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.select'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param SearchRequest $request
     * @param Customer $customer
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Customer $customer)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);
        
        $session = $request->session();
        
        $keyRowsInPage = 'rows_in_page';
        $keyPage = 'page';
        $keySorting = 'sort';
        
        $rowsInPage = $request->get($keyRowsInPage, $session->get($keyRowsInPage, 25));
        $page = $request->get($keyPage, 1);
        $sorting = $request->get($keySorting, $session->get($keySorting, 0));
        
        $args[$keyRowsInPage] = $rowsInPage;
        $args[$keyPage] = $page;
        $args[$keySorting] = $sorting;
        
        $session->put($keyPage, $rowsInPage);
        $session->put($keySorting, $sorting);
        
        $customers = $this->useCase->excute($user, $store, $args);
        $numCustomers = $this->useCase->count($user, $store, $args);
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $customers, 
                $numCustomers, 
                $rowsInPage, 
                $page);
        $paginator->withPath('')
                ->appends('rows_in_page', $rowsInPage);
        
        return view('customers.index', [
            'rows' => $customers,
            'row'  => $customer,
            'paginator' => $paginator,
            'sorting' => $sorting,
            'printSettings' => $user->printSettings()->domainizePrintSettings(true),
            'tags' => $user->company()->tags([
                'store_id' => $storeId,
            ])->groupBy(function ($item) {
                return $item->label();
            }),
        ]);
    }

}
