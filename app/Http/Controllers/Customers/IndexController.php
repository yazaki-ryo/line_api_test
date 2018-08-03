<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\SearchRequest;
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
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.select'),
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
        return view('customers.index', [
            'rows' => $this->useCase->excute($this->auth, $request->validated()),
        ]);
    }

}
