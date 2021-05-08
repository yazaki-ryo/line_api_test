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
use DateTimeImmutable;
use Log;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {

        try {
            $this->validate($request, [
                'date' => 'required|date_format:Y-m-d',
            ]);
            $date = $request->request->get('date');
            $store_obj = new Store;
            if($request->request->get('store_id')){
                $stores = $store_obj->where('store_id','=', $request->request->get('store_id'))->get();
            }elseif($request->request->get('company_id')){
                $stores = $store_obj->where('company_id','=', $request->request->get('company_id'))->get();
            }else{
                $stores = $store_obj->get();
            }

            $line_reservation_obj = new LineReservation;

            $json_res = array();
            $cnt = 0;
            $schedule_str = '';
            foreach($stores AS $store){

                $schedule_str .= " '$cnt' : { ";
                    $schedule_str .= " title : '" . $store->name . "'" ;

                $schedules = $line_reservation_obj->where('store_id','=', $store->id)->where('reserved_at','like', "$date%")->get();
                //$schedules = $line_reservation_obj->where('store_id','=', $store->id)->get();

                $cnt2 = 0;
                if(isset($schedules)){
                    $schedule_str .= ', ';
                    $schedule_str .= 'schedule:[ ';
                }
                foreach($schedules AS $schedule){

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
                    $cnt2++;
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
        return view('line.schedule.index',['schedule' => $schedule_str]);

    }

}

