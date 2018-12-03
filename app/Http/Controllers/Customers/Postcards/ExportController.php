<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Postcards;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Postcards\ExportRequest;
use Domain\Models\User;
use Domain\UseCases\Customers\Postcards\ExportPostcards;

final class ExportController extends Controller
{
    /** @var ExportPostcards */
    private $useCase;

    /**
     * @param  ExportPostcards $useCase
     * @return void
     */
    public function __construct(ExportPostcards $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.postcards.export'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param ExportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(ExportRequest $request)
    {
        /** @var User $user */
        $user = $request->assign();

        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $result = $this->useCase->excute($user, $store, array_merge($args, [
            'mode' => $request->get('mode'),
            'settings' => $this->useCase->getPrintSetting($user, (int)$request->get('setting')),
        ]));

        if ($result === false) {
            flash(__('There is no data that can be output.'), 'warning');
            return back()->withInput();
        }
    }

}
