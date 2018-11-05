<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Postcards;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Postcards\ExportRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Customers\Postcards\ExportPostcards;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

final class ExportController extends Controller
{
    /** @var ExportPostcards */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  ExportPostcards $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(ExportPostcards $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.postcards.export'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param ExportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(ExportRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $args = $request->validated();

        $result = $this->useCase->excute($user, $store, array_merge($args, [
            'settings' => $this->printSettings($request),
        ]));

        if ($result === false) {
            flash(__('There is no data that can be output.'), 'warning');
            return back()->withInput();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    private function printSettings(Request $request): array
    {
        $cookie = $request->cookie(sprintf('%s_%s', config('cookie.name.printings'), $request->mode));

        if (! is_null($cookie)) {
            $cookie = json_decode($cookie, true);
        }

        return $cookie;
    }

}
