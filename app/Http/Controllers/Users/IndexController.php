<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\UseCases\Users\GetUsers;

final class IndexController extends Controller
{
    /** @var GetUsers */
    private $useCase;

    /**
     * @param  GetUsers $useCase
     * @return void
     */
    public function __construct(GetUsers $useCase)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'users.*', 'users.select'),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke()
    {
        $result = $this->useCase->excute();

        return dd($result);
    }

}
