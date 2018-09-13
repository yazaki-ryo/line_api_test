<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\PrintingsRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Settings\Configurations\UpdatePrintings;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

final class PrintingsController extends Controller
{
    /** @var UpdatePrintings */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdatePrintings $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdatePrintings $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'settings.*', 'settings.configurations.printings'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request)
    {
        $cookie1 = $request->cookie('settings_configurations_printings_1');
        $cookie2 = $request->cookie('settings_configurations_printings_2');
        $cookie3 = $request->cookie('settings_configurations_printings_3');

        return view('settings.configurations.printings', [
            'rows' => [
                1 => is_null($cookie1) ? $cookie1 : json_decode($cookie1),
                2 => is_null($cookie2) ? $cookie2 : json_decode($cookie2),
                3 => is_null($cookie3) ? $cookie3 : json_decode($cookie3),
            ],
        ]);
    }

    /**
     * @param  PrintingsRequest $request
     * @param  int $settingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingsRequest $request, int $settingId)
    {
        $cookie = cookie()->forever(sprintf('settings_configurations_printings_%s', $settingId), json_encode($request->validated()));

        flash(__('The :name information was :action.', ['name' => __('elements.words.print') . __('elements.words.set'), 'action' => __('elements.words.updated')]), 'success');

        return redirect()
            ->route('settings.configurations.printings')
            ->cookie($cookie);
    }

}
