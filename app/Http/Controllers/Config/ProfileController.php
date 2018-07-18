<?php
declare(strict_types=1);

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use Domain\UseCases\Config\UpdateProfile;
use Illuminate\Http\Request;
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
     * @param  Request $request
     * @return View
     */
    public function view(Request $request): View
    {
        $id = auth()->user()->getAuthIdentifier();

        return view('config.profile', [
            'row' => $this->useCase->get($id),
        ]);
    }

    /**
     * @param  Request $request
     */
    public function update(Request $request)
    {
        //
    }

}
