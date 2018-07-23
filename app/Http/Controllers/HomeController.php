<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\View\View;

final class HomeController extends Controller
{
    /**
     * @param Router $router
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->middleware('authenticate:user');
    }

    /**
     * @param  Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('home');
    }
}
