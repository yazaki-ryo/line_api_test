<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Log;
use App\Models\Store;
use App\Models\LineReservation;
use DateTimeImmutable;

class ScheduleController extends Controller
{

    public function post(Request $request) {
 
        try {
            $this->validate($request, [
                'id' => 'required|numeric',
                'start' => 'required|date_format:Y-m-d H:i:s',
                'end' => 'required|date',
            ]);

            $line_reservation_obj = new LineReservation;
            $reservation = $line_reservation_obj->find($request->request->get('id'));
            $update_result = $reservation->update([
                'reserved_at' => $request->request->get('start'),
            ]);

            $statusCode = 200;
            $result = [
                'result'     => 'OK'
            ];

        } catch ( Exception $ex ) {
            $statusCode = 400;
            $result = [
                'result'     => 'NG'
            ];
        }

        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT  );
    }

    public function get(Request $request) {

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
            foreach($stores AS $store){
                $json_store_content = array();
                $schedules = $line_reservation_obj->where('store_id','=', $store->id)->where('reserved_at','like', "$date%")->get();

                $json_schedule = array();
                $json_store_content = array();
                $json_store_content['title'] = $store->store_name;
                foreach($schedules AS $schedule){
                    $json_schedule['id'] = $schedule->id;
                    $json_schedule['title'] = $schedule->name;
                    $start_time = new DateTimeImmutable($schedule->start);
                    $json_schedule['start'] = $start_time->format('H:i');
                    $end_time = new DateTimeImmutable($schedule->end);
                    $json_schedule['end'] = $end_time->format('H:i');

                    $json_schedule['data'] = $schedule->reservation_data;
                    $json_store_content['schedule'][] = $json_schedule;
                }
                $json_res[] = $json_store_content;
            }
            $statusCode = 200;
            $result = [
                'rows'     => $json_res
            ];
        } catch ( Exception $ex ) {
            $statusCode = 400;
            $result = [
                'result'     => 'NG'
            ];
        }

        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT  );

    }

}
