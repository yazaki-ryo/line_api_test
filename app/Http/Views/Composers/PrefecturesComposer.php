<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Traits\Cache\Cacheable;
use Domain\Contracts\Model\FindableContract;
use Illuminate\View\View;

final class PrefecturesComposer
{
    use Cacheable;

    /** @var FindableContract */
    private $finder;

    /**
     * @param  FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder)
    {
        $this->finder = $finder;
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
        $view->with(
            'prefectures',
            $this->remember('prefectures', 30, function () {
                return $this->finder->findAll();
            })
        );
    }
}
