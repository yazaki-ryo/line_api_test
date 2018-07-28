<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

final class HomeController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate:user');
    }

    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('home');
    }
}
