<?php
declare(strict_types=1);

namespace App\Http\Controllers\Settings\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use Domain\Models\User;
use Domain\UseCases\Settings\UpdateProfile;
use Illuminate\Http\UploadedFile;

final class UpdateController extends Controller
{
    /** @var UpdateProfile */
    private $useCase;

    /**
     * @param  UpdateProfile $useCase
     * @return void
     */
    public function __construct(UpdateProfile $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param SelfUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(SelfUpdateRequest $request)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();

        /** @var UploadedFile $file */
        $file = $request->file('avatar');

        $callback = function () use ($user, $args, $file) {
            $this->useCase->excute($user, $args, $file);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.user'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('settings.index');
    }

}
