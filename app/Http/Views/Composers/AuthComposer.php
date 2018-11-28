<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;

final class AuthComposer
{
    /** @var Request */
    private $request;

    /**
     * @param  Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (is_null($this->request->user())) {
            return;
        }

        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function create(View $view)
    {
        if (is_null($this->request->user())) {
            return;
        }

        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    private function excute(View $view)
    {
        $view->with('user', $this->request->assign());
    }

}
