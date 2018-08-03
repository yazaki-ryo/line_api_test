<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Domain\Contracts\Sexes\GetSexesInterface;
use Illuminate\View\View;

final class SexesComposer
{
    /** @var GetSexesInterface */
    private $getSexesService;

    /**
     * @param  GetSexesInterface $getSexesService
     * @return void
     */
    public function __construct(GetSexesInterface $getSexesService)
    {
        $this->getSexesService = $getSexesService;
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
        $view->with('sexes', $this->getSexesService->findAll());
    }
}
