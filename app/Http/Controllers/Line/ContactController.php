<?php
declare(strict_types=1);

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Line\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\DB;
//use App\Models\LineAccount;
use App\Models\LineReservation;
use App\Models\Customer;
use App\Models\Store;
use DateTimeImmutable;
use Log;

final class ContactController extends Controller
{

    public function form(Request $request)
    {
        $this->validate($request, [
            'store_id'  => 'required',
        ]);

        // store_idはbase64エンコードされている前提
        $encoded_store_id = $request->request->get('store_id');
        $decoded_store_id = base64_decode($encoded_store_id);
    
//var_dump($decoded_store_id);

        $store_obj = new Store;
        $liff_id = $store_obj->getLiffIdFromStoreId($decoded_store_id) ?? NULL;

        return view('line.contact.form',  [
            'liff_id' => $liff_id,
            'store_id' => $encoded_store_id        
        ]);
    }

    public function confirm(Request $request)
    {

        $this->validate($request, [
            'name'  => 'required',
            'tel' => 'required|numeric|digits_between:8,11',
            'number' => 'required|numeric',
            'time' => 'required',
            'date' => 'required|date',
            'message' => 'present',
        ]);

        $contact = new Contact($request->all());

        return view('confirm', compact('contact'));
    }
    public function process(Request $request)
    {

        // ※要バリデーション
        $this->validate($request, [
            'name'  => 'required',
            'tel' => 'required|numeric|digits_between:8,11',
            'number' => 'required|numeric',
            'time' => 'required|date_format:H:i|',
            'date' => 'required|date',
            'message' => 'present',
            'store_id' => 'required',
        ]);

        $action = $request->get('action', 'back');
        // 二つ目は初期値です。

        $input = $request->except('action');
        // そして、入力内容からは取り除いておきます。

        if($action === 'submit') {

            // リクエスト全要素取得
            $requestArray = $request->toArray(); 

            // ストアID取得
            $encoded_store_id = $request->request->get('store_id');
            $decoded_store_id = base64_decode($encoded_store_id);

Log::info($decoded_store_id);

            // 開始/終了時刻計算
            $date = $request->request->get('date');
            $start_date_time = $date . ' ' . $request->request->get('time') . ':00';
            $start_time = new DateTimeImmutable($start_date_time);
            $end_time = $start_time->modify('+2 hours')->format('Y-m-d H:i:s');
            $date = $start_time->format('Y-m-d');

            // 項目マッピング設定を取得
            $config_json = config("parameters.$decoded_store_id");
            Log::info($config_json);
            $json_arr = json_decode($config_json,true);
            Log::info($json_arr);
            // マッピングできたパラメータを表示
            $line_message = "お問い合わせ内容：【予約】\n\n";
            $line_message_array = array();
            foreach($requestArray AS $key => $val){
                if (array_key_exists($key, $json_arr)) {
                    $display_key = $json_arr[$key];
                    $line_message .= $display_key  . '：' . $val . "\n\n";;
                    $line_message_array[$display_key] = $val;
                }
            }

            // LINEアカウント取得
            $store_obj = new Store;
            $store = $store_obj->where('store_id','=', $decoded_store_id)->first();

            $customer_obj = new Customer;

            DB::beginTransaction();
            try {
                // CustomerをUPSERT TODO:項目が合わない?
                $customer = $customer_obj->updateOrInsert(
                    ['store_id' => $store->id, 'tel' => $request->request->get('tel')],
                    ['tel' => $request->request->get('tel'),
                     'email' => $request->request->get('email'),
                     'created_at' => now(),
                     'updated_at' => now()
                    ]
                );
                $customer = $customer->first();

                // 予約テーブルに入れる
                $reservation_obj = new LineReservation;
                $reservation_data = [
                    'store_id' => $store->id,
                    'customer_id' => $customer->id,
                    'reserved_at' => $start_time,
                    'name' => $request->request->get('name'),
                    'line_message' => $line_message,
                ];
                if($request->request->get('message')){
                    $reservation_data += [
                        'note' => $request->request->get('message')
                    ];
                }
                $reservation_obj->create($reservation_data);

                Log::info('Line message_result:'. $line_message);            
                Log::info('Line store_id:'. $encoded_store_id);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // 戻る?
                return redirect('/contact');
            }

            return redirect('/contact?store_id='.$encoded_store_id)->with('line_message', json_encode($line_message));


        } else {

            // 戻る
            return redirect('/contact');
        }
    }


}
