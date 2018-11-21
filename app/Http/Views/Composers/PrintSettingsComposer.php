<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class PrintSettingsComposer
{
    /** @var Auth */
    private $auth;

    /**
     * @param  Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function create(View $view)
    {
        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    private function excute(View $view)
    {
        $view->with('defaults', config('pdf.defaults.general'));
        $view->with('fonttypes', config('pdf.fonttypes'));
        $view->with('fontsizes', config('pdf.fontsizes'));
        $view->with('positions', config('pdf.positions'));
    }

}
