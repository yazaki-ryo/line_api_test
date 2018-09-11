<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Files\ImportRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Customers\Files\ImportFiles;
use Illuminate\Contracts\Auth\Factory as Auth;

final class ImportController extends Controller
{
    /** @var ImportFiles */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  ImportFiles $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(ImportFiles $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.files.import'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view()
    {
        return view('customers.files.import');
    }

    /**
     * @param ImportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(ImportRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        return $this->useCase->excute($user, $args);
    }

}
