<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings\Printings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\PrintingsRequest;
use App\Repositories\UserRepository;
use Domain\Models\PrintSetting;
use Domain\Models\User;
use Domain\UseCases\Settings\UpdatePrintings;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

final class UpdateController extends Controller
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
            sprintf('authenticate:%s', $this->guard),
            'authorize:self-settings.printings.update',
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param PrintSetting $printSetting
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, PrintSetting $printSetting)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        return view('settings.printings.edit', [
            'rows' => [
                1 => $this->useCase->getPrintSetting($user, 1),
                2 => $this->useCase->getPrintSetting($user, 2),
                3 => $this->useCase->getPrintSetting($user, 3),
            ],
            'brankPrintSetting' => $printSetting,
        ]);
    }

    /**
     * @param  PrintingsRequest $request
     * @param  int $settingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PrintingsRequest $request, int $settingId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        $callback = function () use ($user, $settingId, $args) {
            $this->useCase->excute($user, $settingId, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.print') . __('elements.words.setting'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.printings.edit');
    }

}
