<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems;

final class HomeController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate:administrator');
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke()
    {
        return view(sprintf('%s.home', $this->prefix));
    }
}
