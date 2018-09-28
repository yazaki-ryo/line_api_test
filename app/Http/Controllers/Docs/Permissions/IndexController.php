<?php
declare(strict_types=1);

namespace App\Http\Controllers\Docs\Permissions;

use App\Http\Controllers\Controller;
use App\Services\PermissionsService;
use App\Services\RolesService;
use Domain\Models\Permission;
use Domain\Models\Role;

final class IndexController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authenticate:user');
    }

    /**
     * @param PermissionsService $service
     * @param RolesService $rolesService
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(PermissionsService $permissionsService, RolesService $rolesService)
    {
        return view('docs.permissions.index', [
            'systemAdmin'  => collect(config('permissions.default.system.system-admin')),
            'companyAdmin' => collect(config('permissions.default.general.company-admin')),
            'storeUser'    => collect(config('permissions.default.general.store-user')),

            'permissions' => $permissionsService->findAll()->groupBy(function (Permission $item) {
                return $item->label();
            }),

            'roles' => $rolesService->findAll()->map(function (Role $item) {
                return [
                    'slug'   => $item->slug(),
                    'name' => $item->name(),
                ];
            })->pluck('name', 'slug')->all(),
        ]);
    }
}
