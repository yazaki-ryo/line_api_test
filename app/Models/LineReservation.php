<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineReservation extends Model
{
    //protected $table = 'line_reservations';
    protected $table = 'reservations';

    protected $guarded = array('id');
  
    public $timestamps = true;

    // 顧客情報
    //public function customer() {
    //	return $this->belongsTo('App\Models\customer');
    //}

    public function getSchedule($store_id, $date)
    {
      $schedule = $this->where('store_id','=', $store_id)->where('date','=', $date);

      if($schedule){
          return $schedule;
      }else{
          return;
      }
    }

}
