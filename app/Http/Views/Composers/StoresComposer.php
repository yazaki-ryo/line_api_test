<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Services\StoresService;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class StoresComposer
{
    /** @var StoresService */
    private $service;

    /** @var Auth */
    private $auth;

    /**
     * @param  StoresService  $service
     * @param  Auth $auth
     * @return void
     */
    public function __construct(StoresService $service, Auth $auth)
    {
        $this->service = $service;
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
        $args = $this->domainize($this->auth);

        $view->with('stores', $this->service->findAll($args));
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return array
     */
    private function domainize(Auth $auth, array $args = []): array
    {
        $args = collect($args);

        /**
         * XXX TODO ここの処理はGetCustomersユースケースと酷似しているので、いずれ要調整
         */

        $args->put('company_id', optional($auth->user()->store)->company_id);

        if ($auth->user()->cant('roles', 'company-admin')) {
            $args->put('id', $auth->user()->store_id);
        }

        return $args->all();
    }
}
