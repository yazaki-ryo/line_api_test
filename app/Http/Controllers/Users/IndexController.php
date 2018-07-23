<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\UseCases\Users\GetUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\View\View;

final class IndexController extends Controller
{
    /** @var GetUsers */
    private $useCase;

    /**
     * @param  GetUsers $useCase
     * @param  Router $router
     * @return void
     */
    public function __construct(GetUsers $useCase, Router $router)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'users.*', $router->currentRouteName()),
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

        return dd($result);
    }

}
