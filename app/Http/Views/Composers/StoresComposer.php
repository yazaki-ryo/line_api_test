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
        if (! $this->auth->check()) return;

        $user = UserRepository::toModel($this->auth->user());

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        /** @var DomainCollection $stores */
        $collection = new DomainCollection;

        if ($user->can('authorize', 'customers.select') && ! is_null($company)) {
            // TODO
        } elseif ($user->can('authorize', 'own-company-customers.select') && ! is_null($company)) {
            $collection = $company->stores();
        } elseif ($user->can('authorize', 'own-company-self-store-customers.select') && ! is_null($store)) {
            $collection = $collection->push($store);
        }

        $view->with('stores', $collection);
    }

}
