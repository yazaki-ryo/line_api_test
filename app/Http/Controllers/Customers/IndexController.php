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

    private function mergeParameter(SearchRequest $request) {
        $args = $request->validated();
      
        $session = $request->session();
        
        if ($request->isMethod('get')) {
            $sessionData = collect($session->all());
            foreach ($sessionData as $sessionKey => $sessionValue) {
                $args[$sessionKey] = $sessionValue;
            }
        } else if ($request->isMethod('post')) {
            $session->forget('tags');
            foreach (['free_word', 'visited_date_s', 'visited_date_e', 'mourning_flag', 'tags',] as $key) {
                if (array_key_exists($key, $args)) {
                    $session->put($key, $args[$key]);
                }
            }
        }
        
        $ret = $session->all();
        
        $keyRowsInPage = 'rows_in_page';
        $keyPage = 'page';
        $keySorting = 'sort';
        
        $rowsInPage = $request->get($keyRowsInPage, $session->get($keyRowsInPage, 25));
        $page = $request->get($keyPage, 1); // use 1 for default, does not use session value
        $sorting = $request->get($keySorting, $session->get($keySorting, 0));
        
        $ret[$keyRowsInPage] = $rowsInPage;
        $ret[$keyPage] = $page;
        $ret[$keySorting] = $sorting;
        
        $session->put($keyRowsInPage, $rowsInPage);
        $session->put($keyPage, $page);
        $session->put($keySorting, $sorting);
        
        return $ret;
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
        $args = $this->mergeParameter($request);
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);
        
        $rowsInPage = $args['rows_in_page'];
        $page = $args['page'];
        $sorting = $args['sort'];
        
        $customers = $this->useCase->excute($user, $store, $args);
        $numCustomers = $this->useCase->count($user, $store, $args);
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $customers, 
                $numCustomers, 
                $rowsInPage, 
                $page);
        $paginator->withPath('')
                ->appends('tab', 'index')
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

    /**
     * @param SearchRequest $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function listAjax(SearchRequest $request)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);
        
        $customers = $this->useCase->excute($user, $store, $args);
        $totalCustomers = $this->useCase->count($user, $store, $args);
        
        return response()->json([
            'customers' => $customers->toPlainObject(),
            'totalCustomers' => $totalCustomers,
        ]);
    }
}
