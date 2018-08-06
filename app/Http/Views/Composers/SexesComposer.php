<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Services\SexesService;
use Illuminate\View\View;

final class SexesComposer
{
    /** @var SexesService */
    private $service;

    /**
     * @param  SexesService $service
     * @return void
     */
    public function __construct(SexesService $service)
    {
        $this->service = $service;
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
        $view->with('sexes', $this->service->findAll());
    }
}
