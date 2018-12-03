<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Files\ImportRequest;
use Domain\Models\User;
use Domain\UseCases\Customers\Files\ImportFiles;

final class ImportController extends Controller
{
    /** @var ImportFiles */
    private $useCase;

    /**
     * @param  ImportFiles $useCase
     * @return void
     */
    public function __construct(ImportFiles $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.files.import'))),
        ]);

        $this->useCase = $useCase;
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
        $user = $request->assign();
        $args = $request->validated();

        return $this->useCase->excute($user, $args);
    }

}
