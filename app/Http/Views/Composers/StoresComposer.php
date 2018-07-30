<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Domain\Contracts\Stores\GetStoresInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class StoresComposer
{
    /** @var GetStoresInterface */
    private $getStoresService;

    /** @var Auth */
    private $auth;

    /**
     * @param  GetStoresInterface  $getStoresService
     * @param  Auth $auth
     * @return void
     */
    public function __construct(GetStoresInterface $getStoresService, Auth $auth)
    {
        $this->getStoresService = $getStoresService;
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

        $view->with('stores', $this->getStoresService->findAll($args));
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return array
     */
    private function domainize(Auth $auth, array $args = []): array
    {
        $args = collect($args);

        $args->put('company_id', optional($auth->user()->store)->company_id);

        if ($auth->user()->cant('roles', 'company-admin')) {
            $args->put('id', $auth->user()->store_id);
        }

        return $args->all();
    }
}
