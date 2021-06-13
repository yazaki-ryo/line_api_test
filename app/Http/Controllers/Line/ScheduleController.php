<?php
declare(strict_types=1);

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Line\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Store;
use App\Models\LineReservation;
use App\Models\Seat;
use DateTimeImmutable;
use Log;

class ScheduleController extends Controller
{
    public function __construct()
    {
        putenv("APP_DEBUG=false");
    }

    public function index(Request $request)
    {

        try {
            $this->validate($request, [
                'date' => 'date_format:Y-m-d',
            ]);

            $storeId = $request->cookie(config('cookie.name.current_store'));

            if($request->request->get('date')){
                $date = $request->request->get('date');
            }else{
                $date = date("Y-m-d");
            }
            $store_obj = new Store;
            $stores = $store_obj->where('id','=', $storeId)->get();

            $json_res = array();
            $cnt = 0;
            $schedule_str = '';
            $store = $stores->first();

            // 席
            $seat_obj = new Seat;
            $seats_datas = $seat_obj->where('store_id','=', $store->id)->get();

            // 予約
            $line_reservation_obj = new LineReservation;
            $schedules = $line_reservation_obj->where('store_id','=', $store->id)->where('reserved_at','like', "$date%")->get();

            //退避
            $seats = [];
            foreach($seats_datas AS $seats_data){
                $seats[] = [
                    'id' => $seats_data->id,
                    'name' => $seats_data->name,
                ];
            }
            $seats[] = [
                'id' => 99,
                'name' => '未定',
            ];
            // 予約順にループ
            $filled = [];
            foreach($seats AS $k => $seat){
                $schedule_str .= " '$cnt' : { ";
                $schedule_str .= " title : '" . $seat['name'] . "'" ;
                $cnt2 = 0;
                if(isset($schedules)){
                    $schedule_str .= ', ';
                    $schedule_str .= 'schedule:[ ';
                }
                foreach($schedules AS $schedule){     
                    // 予約と席マスタ照合
                    if(($schedule->seat == $seat['id'])
                    ||  (empty($schedule->seat) && $seat['id'] == 99 )
                    ){
                        if($cnt2 != 0){
                            $schedule_str .= ',';
                        }
                        $schedule_str .= '{ ';
                        $start_time = new DateTimeImmutable($schedule->reserved_at);
                        $schedule_str .= " start : '" . $start_time->format('H:i') . "'," ;
                        $end_time = $start_time->modify("+2 hour");
                        //$end_time = new DateTimeImmutable($schedule->end);
                        $schedule_str .= " end : '" . $end_time->format('H:i') . "'," ;
                        $schedule_str .= " text : '" . $schedule->name . "'," ;
                            $schedule_str .= " data : { " ;
                            $schedule_str .= " id : '" . $schedule->id . "'," ;
                            $schedule_str .= " date : '" . $date. "'" ;
                            $schedule_str .= '}';
                        $schedule_str .= '}';
                        $filled[] = $schedule->id;
                        $cnt2++;
                    }
                }
                $schedule_str = rtrim($schedule_str, ',');
                if(isset($schedules)){
                    $schedule_str = rtrim($schedule_str, ',');
                    $schedule_str .= ']';
                }

                $schedule_str .= " },";

                $cnt++;
            }
            $schedule_str = rtrim($schedule_str, ',');

        } catch ( Exception $ex ) {
            Log::error('スケジュール作成失敗');
        }

        return view('line.schedule.index',['schedule' => $schedule_str, 'date' => $date]);

    }

}

