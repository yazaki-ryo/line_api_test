<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Repositories\UserRepository;
use App\Services\DomainCollection;
use Domain\Models\Company;
use Domain\Models\Store;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class StoresComposer
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
        $user = UserRepository::toModel($this->auth->user());

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        /** @var DomainCollection $stores */
        $stores = new DomainCollection;

        if (! is_null($company) && $user->can('roles', 'company-admin')) {
            $stores = $company->stores();
        } elseif (! is_null($store) && $user->can('roles', 'store-user')) {
            $stores = $stores->push($store);
        }

        $view->with('stores', $stores);
    }

}
