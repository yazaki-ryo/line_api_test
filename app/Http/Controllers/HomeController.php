<?php
declare(strict_types=1);

namespace App\Http\Controllers;

final class HomeController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware(sprintf('authenticate:%s', $this->guard));
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke()
    {
        return redirect()->route('customers.index', ['tab' => 'customers_search_request']);
    }
}
