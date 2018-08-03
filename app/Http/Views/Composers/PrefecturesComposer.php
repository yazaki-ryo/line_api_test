<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Domain\Contracts\Prefectures\GetPrefecturesInterface;
use Illuminate\View\View;

final class PrefecturesComposer
{
    /** @var GetPrefecturesInterface */
    private $getPrefecturesService;

    /**
     * @param  GetPrefecturesInterface  $getPrefecturesService
     * @return void
     */
    public function __construct(GetPrefecturesInterface $getPrefecturesService)
    {
        $this->getPrefecturesService = $getPrefecturesService;
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
        $view->with('prefectures', $this->getPrefecturesService->findAll());
    }
}
