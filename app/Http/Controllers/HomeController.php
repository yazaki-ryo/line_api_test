<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class HomeController extends Controller
{
    /**
     * @param Router $router
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->middleware('authenticate:web');
    }

    /**
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('home');
    }
}
