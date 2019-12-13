<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Magazines;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Domain\Models\User;
use Domain\UseCases\Customers\Magazines\Event;

final class EventController extends Controller
{
    /** @var Event */
    private $useCase;

    /**
     * @param  Event $useCase
     * @return void
     */
    public function __construct(Event $useCase)
    {
        // $this->middleware([
        //     sprintf('authenticate:%s', $this->guard),
        //     sprintf('authorize:%s', implode('|', config('permissions.groups.customers.create'))),
        // ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {   
        \Log::debug("【コントローラー受信確認】" );
        if($request->isMethod('post')) {
            \Log::debug("【キー】" . print_r($request->all()) . "です" );
            $response = $this->useCase->excute();
        }
    }

}
