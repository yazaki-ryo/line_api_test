<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Docs\Permissions;

use App\Http\Controllers\Systems\Controller;
use App\Services\PermissionsService;
use Domain\Models\Permission;

final class IndexController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate:administrator');
    }

    /**
     * @param PermissionsService $service
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(PermissionsService $permissionsService)
    {
        return view('docs.permissions.index', [
            'systemAdmin'  => collect(config('permissions.default.system.system-admin')),
            'companyAdmin' => collect(config('permissions.default.general.company-admin')),
            'storeUser'    => collect(config('permissions.default.general.store-user')),

            'permissions' => $permissionsService->findAll()->groupBy(function (Permission $item) {
                return $item->label();
            }),
        ]);
    }
}
