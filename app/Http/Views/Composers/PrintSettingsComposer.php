<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Illuminate\View\View;

final class PrintSettingsComposer
{
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
