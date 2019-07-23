<?php
declare(strict_types=1);

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservations\SearchRequest;
use Domain\Models\Reservation;
use Domain\Models\User;
use Domain\UseCases\Reservations\GetReservations;
use Illuminate\Support\Facades\Log;

final class IndexController extends Controller
{
    /** @var GetReservations */
    private $useCase;

    /**
     * @param  GetReservations $useCase
     * @return void
     */
    public function __construct(GetReservations $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.reservations.select'))),
        ]);

        $this->useCase = $useCase;
    }

    private function mergeParameter(SearchRequest $request) {
        $args = $request->validated();
      
        $session = $request->session();
        $sessionData = collect($session->all());
        
        foreach ($args as $key => $value) {
            $session->put($key, $value);
        }
        
        $ret = $session->all();
        Log::debug($ret);
        
        $keyRowsInPage = 'rows_in_page';
        $keyPage = 'page';
        $keySorting = 'sort';
        
        $rowsInPage = $request->get($keyRowsInPage, $session->get($keyRowsInPage, 25));
        $page = $request->get($keyPage, 1); // use 1 for default, does not use session value
        $sorting = $request->get($keySorting, $session->get($keySorting, 0));
        
        $ret[$keyRowsInPage] = $rowsInPage;
        $ret[$keyPage] = $page;
        $ret[$keySorting] = $sorting;
        
        $session->put($keyRowsInPage, $rowsInPage);
        $session->put($keyPage, $page);
        $session->put($keySorting, $sorting);
        
        Log::debug($ret);
        return $ret;
    }
    
    /**
     * @param SearchRequest $request
     * @param Reservation $reservation
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Reservation $reservation)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $this->mergeParameter($request);
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $rowsInPage = $args['rows_in_page'];
        $page = $args['page'];
        $sorting = $args['sort'];
        
        $session = $request->session();
        $postdata = $session->get('_old_input');
        $customer_id = is_array($postdata) ? (array_key_exists('customer_id', $postdata) ? $postdata['customer_id'] : 0) : 0;
        
        $reservations = $this->useCase->excute($user, $store, $args);
        $totalReservations = $this->useCase->count($user, $store, $args);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $reservations, 
                $totalReservations, 
                $rowsInPage, 
                $page);
        $paginator->withPath('')
                ->appends('tab', 'index')
                ->appends('rows_in_page', $rowsInPage);
        
        return view('reservations.index', [
            'customer_id' => $customer_id,
            'reserved_date' => array_key_exists('reserved_date', $args) ? $args['reserved_date'] : null,
            'rows' => $reservations,
            'row' => $reservation,
            'paginator' => $paginator,
            'sorting' => $sorting,
            'tab' => count($args) ? 'index' : 'calender',
        ]);
    }

    /**
     * @param SearchRequest $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function listAjax(SearchRequest $request)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);
        
        $reservations = $this->useCase->excute($user, $store, $args);
        
        /*
        予約数合計をまとめる処理 
        
        $tmp = [];
        foreach($reservations as $reservation) {
            $date = $reservation->reservedAt();
            $tmp[$date->format('Y-m-d')][] = $date->format('Y-m-d H:i:s');
        }
        "予約数:" . count($tmp[$date->format('Y-m-d')]);
        */

        $data = [];
        foreach($reservations as $key => $reservation) {
            $date = $reservation->reservedAt();
            $data[$key]['id'] = $reservation->id();
            $data[$key]['title'] = $reservation->name();
            $data[$key]['start'] = $date->format('Y-m-d H:i:s');
            $data[$key]['color'] = 'red';
        }

        return response()->json($data);
    }

}
