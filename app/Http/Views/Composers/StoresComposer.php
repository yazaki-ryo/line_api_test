<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Services\DomainCollection;
use Cookie;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class StoresComposer
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
        /** @var User $user */
        $user = $this->request->assign();

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        /** @var DomainCollection $stores */
        $stores = new DomainCollection;

        if ($user->can('authorize', 'own-company-stores.select') && ! is_null($company)) {
            $stores = $company->stores();
        } elseif ($user->can('authorize', 'own-company-self-store.select') && ! is_null($store)) {
            $stores = $stores->push($store);
        }

        $view->with('stores', $stores);

        if (is_numeric($value = Cookie::get(config('cookie.name.current_store')))) {
            $view->with(
                'currentStore',
                $stores->filter(function (Store $item) use ($value){
                    return $item->id() === (int)$value;
                })->first()
            );
        }
    }

}
