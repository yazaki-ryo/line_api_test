<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Services\PrefecturesService;
use Illuminate\View\View;

final class PrefecturesComposer
{
    /** @var PrefecturesService */
    private $service;

    /**
     * @param  PrefecturesService  $service
     * @return void
     */
    public function __construct(PrefecturesService $service)
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
        $view->with('prefectures', $this->service->findAll());
    }
}
