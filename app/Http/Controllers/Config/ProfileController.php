<?php
declare(strict_types=1);

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\SelfUpdateRequest;
use Domain\UseCases\Config\UpdateProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\View\View;

final class ProfileController extends Controller
{
    /** @var UpdateProfile */
    private $useCase;

    /**
     * @param  UpdateProfile $useCase
     * @param  Router $router
     * @return void
     */
    public function __construct(UpdateProfile $useCase, Router $router)
    {
        $this->middleware([
            'authenticate:web',
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $id = auth()->user()->getAuthIdentifier();

        return view('config.profile', [
            'row' => $this->useCase->getUser($id),
        ]);
    }

    /**
     * @param  SelfUpdateRequest $request
     */
    public function update(SelfUpdateRequest $request)
    {
        $id = auth()->user()->getAuthIdentifier();
        $inputs = $this->fill($request);

        $callback = function () use ($id, $inputs) {
            $this->useCase->excute($id, $inputs);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The registration information was updated.'), 'success');
        return redirect()->route('config.profile');
    }

    /**
     * @param FormRequest $request
     * @return array
     */
    private function fill(FormRequest $request): array
    {
        $inputs = $request->validated();

        if ($request->filled('password')) {
            $inputs['password'] = bcrypt($request->get('password'));
        } else {
            unset($inputs['password']);
        }

        return $inputs;
    }

}
