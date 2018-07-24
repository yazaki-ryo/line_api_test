<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Domain\UseCases\Customers\GetCustomers;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\View\View;

final class IndexController extends Controller
{
    /** @var GetCustomers */
    private $useCase;

    /**
     * @param  GetCustomers $useCase
     * @param  Router $router
     * @return void
     */
    public function __construct(GetCustomers $useCase, Router $router)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', $router->currentRouteName()),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param  Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $result = $this->useCase->excute();

        return view('customers.index', [
            'rows' => $result,
        ]);
    }

}
