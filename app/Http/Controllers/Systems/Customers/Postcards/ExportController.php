<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Customers\Postcards;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Customers\Postcards\ExportRequest;
use App\Repositories\EloquentRepository;
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
        $user = EloquentRepository::assign($this->auth->user(), true);
        $args = $request->validated();
        $args['settings'] = $this->printSettings($request);

        $result = $this->useCase->excute($user, $args);

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
        $cookie = $request->cookie(sprintf('settings_printings_%s', $request->mode));

        if (! is_null($cookie)) {
            $cookie = json_decode($cookie, true);
        }

        return $cookie;
    }

}
